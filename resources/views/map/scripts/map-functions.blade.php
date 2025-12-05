<script>
// وظائف الخريطة الاحترافية
window.MapFunctions = {
    initMap(userLocation) {
        const map = L.map('map', {
            center: [userLocation.lat, userLocation.lng],
            zoom: 13,
            zoomControl: false, // سنضيف custom zoom control
            minZoom: 5,
            maxZoom: 22,
            zoomAnimation: true,
            fadeAnimation: true,
            markerZoomAnimation: true,
            preferCanvas: true, // أداء أفضل
            renderer: L.canvas()
        });
        
        // Custom Zoom Control مع تصميم احترافي
        L.control.zoom({
            position: 'bottomleft',
            zoomInText: '<span style="font-size: 20px;">+</span>',
            zoomOutText: '<span style="font-size: 20px;">−</span>',
            zoomInTitle: 'تكبير',
            zoomOutTitle: 'تصغير'
        }).addTo(map);
        
        return map;
    },

    loadMapTiles(map, provider) {
        let url = provider.url;
        if (provider.key) {
            url = url.replace('{key}', provider.key);
        }

        const tileLayer = L.tileLayer(url, {
            attribution: provider.attribution,
            crossOrigin: 'anonymous',
            ...provider.options,
            className: 'map-tiles', // للتحكم في الانتقالات
        });
        
        tileLayer.on('tileerror', (error) => console.error('Tile error:', error));
        tileLayer.addTo(map);
        return tileLayer;
    },

    // Custom Animated User Marker
    addUserMarker(map, lat, lng) {
        const pulsingIcon = L.divIcon({
            className: 'pulsing-marker',
            html: `
                <div class="user-location-marker">
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring" style="animation-delay: 0.5s;"></div>
                    <div class="user-dot"></div>
                </div>
            `,
            iconSize: [50, 50],
            iconAnchor: [25, 25]
        });
        
        return L.marker([lat, lng], { icon: pulsingIcon })
            .addTo(map)
            .bindPopup('<div class="custom-popup"><strong>📍 موقعك الحالي</strong></div>');
    },

    // Enhanced Service Marker مع Shadow
    addServiceMarker(map, service, clickHandler) {
        const markerIcon = L.divIcon({
            className: 'service-marker',
            html: `
                <div class="marker-container" data-service="${service.id}">
                    <div class="marker-shadow"></div>
                    <div class="marker-pin" style="background: linear-gradient(135deg, ${this.getServiceColor(service.icon)} 0%, ${this.getServiceColorDark(service.icon)} 100%);">
                        <span class="marker-icon">${service.icon}</span>
                    </div>
                    <div class="marker-pulse"></div>
                </div>
            `,
            iconSize: [40, 50],
            iconAnchor: [20, 50],
            popupAnchor: [0, -50]
        });

        const marker = L.marker([service.lat, service.lng], { 
            icon: markerIcon,
            riseOnHover: true
        }).addTo(map);

        // Hover effect
        marker.on('mouseover', function() {
            this._icon.querySelector('.marker-container').classList.add('marker-hover');
        });
        
        marker.on('mouseout', function() {
            this._icon.querySelector('.marker-container').classList.remove('marker-hover');
        });

        marker.on('click', () => clickHandler(service));
        
        // Custom Popup
        marker.bindPopup(`
            <div class="premium-popup">
                <div class="popup-header" style="background: linear-gradient(135deg, ${this.getServiceColor(service.icon)}, ${this.getServiceColorDark(service.icon)});">
                    <span class="popup-icon">${service.icon}</span>
                    <h3>${service.name}</h3>
                </div>
                <div class="popup-body">
                    <div class="popup-item">
                        <span class="popup-label">📍</span>
                        <span class="popup-text">${service.address}</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">📞</span>
                        <span class="popup-text">${service.phone}</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">⏱️</span>
                        <span class="popup-text">${service.eta}</span>
                    </div>
                </div>
                <button class="popup-button" onclick="window.mapApp.navigateToService(${JSON.stringify(service).replace(/"/g, '&quot;')})">
                    🧭 الاتجاهات
                </button>
            </div>
        `, {
            maxWidth: 300,
            className: 'custom-leaflet-popup'
        });

        return marker;
    },

    // Project Marker مع Animation
    addProjectMarker(map, project) {
        const completionColor = project.completion > 70 ? '#10b981' : project.completion > 40 ? '#f59e0b' : '#ef4444';
        
        const projectIcon = L.divIcon({
            className: 'project-marker',
            html: `
                <div class="project-marker-container">
                    <div class="project-pin" style="background: ${completionColor};">
                        <span>${project.icon}</span>
                        <div class="project-progress" style="height: ${project.completion}%"></div>
                    </div>
                </div>
            `,
            iconSize: [35, 45],
            iconAnchor: [17.5, 45]
        });

        return L.marker([project.lat, project.lng], { icon: projectIcon })
            .addTo(map)
            .bindPopup(`
                <div class="premium-popup project-popup">
                    <div class="popup-header" style="background: ${completionColor};">
                        <span class="popup-icon">${project.icon}</span>
                        <h3>${project.name}</h3>
                    </div>
                    <div class="popup-body">
                        <div class="popup-item">
                            <span class="popup-label">📍</span>
                            <span class="popup-text">${project.location}</span>
                        </div>
                        <div class="popup-item">
                            <span class="popup-label">🏗️</span>
                            <span class="popup-text">${project.contractor}</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-label">
                                <span>نسبة الإنجاز</span>
                                <span class="progress-value">${project.completion}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${project.completion}%; background: ${completionColor};"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `, {
                className: 'custom-leaflet-popup'
            });
    },

    // Enhanced Heatmap
    addHeatmap(map, data, gradient) {
        return L.heatLayer(data, {
            radius: 30,
            blur: 20,
            maxZoom: 18,
            gradient: gradient,
            minOpacity: 0.4
        }).addTo(map);
    },

    // Enhanced Route مع Glow Effect
    createRoute(map, from, to) {
        const waypoints = [
            L.latLng(from.lat, from.lng),
            L.latLng(to.lat, to.lng)
        ];

        const routingControl = L.Routing.control({
            waypoints: waypoints,
            routeWhileDragging: false,
            show: false,
            createMarker: () => null,
            lineOptions: {
                styles: [
                    { color: '#3b82f6', opacity: 0.2, weight: 12 }, // Glow
                    { color: '#2563eb', opacity: 0.8, weight: 6 }   // Main line
                ],
                extendToWaypoints: true,
                missingRouteTolerance: 0
            },
            router: L.Routing.osrmv1({
                serviceUrl: 'https://router.project-osrm.org/route/v1',
                language: 'ar'
            })
        }).addTo(map);

        return routingControl;
    },

    // Marker Clustering
    createMarkerCluster(map) {
        return L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 50,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                let size = 'small';
                if (count > 10) size = 'medium';
                if (count > 20) size = 'large';
                
                return L.divIcon({
                    html: `<div class="cluster-marker cluster-${size}"><span>${count}</span></div>`,
                    className: 'marker-cluster-custom',
                    iconSize: L.point(40, 40)
                });
            }
        });
    },

    // Helper: Get Service Color
    getServiceColor(icon) {
        const colors = {
            '🏥': '#ef4444', '🚑': '#f97316', '🚒': '#dc2626',
            '👮': '#3b82f6', '🏫': '#0ea5e9', '🛒': '#f59e0b',
            '🍽️': '#ec4899', '🕌': '#8b5cf6'
        };
        return colors[icon] || '#6366f1';
    },

    getServiceColorDark(icon) {
        const colors = {
            '🏥': '#dc2626', '🚑': '#ea580c', '🚒': '#b91c1c',
            '👮': '#2563eb', '🏫': '#0284c7', '🛒': '#d97706',
            '🍽️': '#db2777', '🕌': '#7c3aed'
        };
        return colors[icon] || '#4f46e5';
    },

    // إضافة 3D Buildings Layer
    add3DBuildings(map) {
        const buildingsLayer = L.tileLayer('https://api.maptiler.com/tiles/v3/{z}/{x}/{y}.pbf?key=FTEwYIdJtQUe56EPWul2', {
            style: 'https://api.maptiler.com/maps/streets/style.json?key=FTEwYIdJtQUe56EPWul2'
        });
        return buildingsLayer;
    },

    // Terrain/Hillshade Layer
    addTerrainLayer(map, key) {
        return L.tileLayer(`https://api.maptiler.com/tiles/terrain-rgb/{z}/{x}/{y}.png?key=${key}`, {
            attribution: '© MapTiler',
            opacity: 0.5
        }).addTo(map);
    },

    // Traffic Layer (محاكاة طبقة الازدحام)
    addTrafficLayer(map, trafficData) {
        const trafficLines = [];
        
        trafficData.forEach(road => {
            const color = this.getTrafficColor(road.congestion);
            const line = L.polyline(road.coordinates, {
                color: color,
                weight: 6,
                opacity: 0.8,
                smoothFactor: 1,
                className: 'traffic-line'
            }).addTo(map);
            
            line.bindTooltip(`
                <div style="text-align: right; font-family: 'Cairo';">
                    <strong>${road.name}</strong><br>
                    <span style="color: ${color};">● ${road.status}</span><br>
                    <small>متوسط السرعة: ${road.speed} كم/س</small>
                </div>
            `, { 
                sticky: true,
                className: 'traffic-tooltip'
            });
            
            trafficLines.push(line);
        });
        
        return trafficLines;
    },

    getTrafficColor(level) {
        const colors = {
            'low': '#10b981',      // أخضر - سالك
            'medium': '#f59e0b',   // برتقالي - ازدحام متوسط
            'high': '#ef4444',     // أحمر - ازدحام شديد
            'blocked': '#dc2626'   // أحمر غامق - مغلق
        };
        return colors[level] || '#6b7280';
    },

    // Weather Layer (طبقة الطقس)
    addWeatherLayer(map, key) {
        return L.tileLayer(`https://tile.openweathermap.org/map/precipitation_new/{z}/{x}/{y}.png?appid=${key}`, {
            attribution: '© OpenWeatherMap',
            opacity: 0.5
        });
    },

    // Animated Route مع سيارة متحركة
    animateRouteWithCar(map, route, duration = 5000) {
        const carIcon = L.divIcon({
            className: 'moving-car-icon',
            html: `
                <div class="car-container">
                    <div class="car-shadow"></div>
                    <div class="car-body">🚗</div>
                </div>
            `,
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        const carMarker = L.marker(route[0], { 
            icon: carIcon,
            zIndexOffset: 1000
        }).addTo(map);

        let index = 0;
        const steps = route.length;
        const stepDuration = duration / steps;

        const animate = () => {
            if (index < steps - 1) {
                const start = route[index];
                const end = route[index + 1];
                
                // حساب الزاوية للسيارة
                const angle = Math.atan2(end[1] - start[1], end[0] - start[0]) * 180 / Math.PI;
                
                carMarker.setLatLng(end);
                carMarker._icon.style.transform += ` rotate(${angle}deg)`;
                
                index++;
                setTimeout(animate, stepDuration);
            } else {
                // Animation completed
                setTimeout(() => {
                    map.removeLayer(carMarker);
                }, 1000);
            }
        };

        animate();
        return carMarker;
    },

    // Isochrone (مناطق الوصول في وقت محدد)
    drawIsochrone(map, center, minutes, color = '#3b82f6') {
        // محاكاة - في الواقع يحتاج API مثل Mapbox Isochrone
        const radius = minutes * 1000; // تقريبي: 1 كم في الدقيقة
        
        return L.circle([center.lat, center.lng], {
            radius: radius,
            color: color,
            fillColor: color,
            fillOpacity: 0.2,
            weight: 2,
            dashArray: '5, 10'
        }).addTo(map).bindPopup(`
            <div style="text-align: center; font-family: 'Cairo';">
                <strong>منطقة الوصول</strong><br>
                <span>${minutes} دقيقة</span>
            </div>
        `);
    },

    // Draw Zones (رسم مناطق معينة)
    drawServiceZone(map, center, radius, zoneName, color = '#8b5cf6') {
        const circle = L.circle([center.lat, center.lng], {
            radius: radius,
            color: color,
            fillColor: color,
            fillOpacity: 0.15,
            weight: 3,
            dashArray: '10, 5',
            className: 'service-zone'
        }).addTo(map);

        const label = L.marker([center.lat, center.lng], {
            icon: L.divIcon({
                className: 'zone-label',
                html: `<div class="zone-label-text">${zoneName}</div>`,
                iconSize: [100, 30]
            }),
            interactive: false
        }).addTo(map);

        return { circle, label };
    },

    // Measure Distance Tool (أداة قياس المسافة)
    enableMeasureTool(map) {
        let points = [];
        let lines = [];
        let markers = [];
        let totalDistance = 0;

        const measureMarkerIcon = L.divIcon({
            className: 'measure-marker',
            html: '<div class="measure-dot"></div>',
            iconSize: [10, 10]
        });

        map.on('click', function(e) {
            points.push(e.latlng);
            
            const marker = L.marker(e.latlng, { icon: measureMarkerIcon }).addTo(map);
            markers.push(marker);

            if (points.length > 1) {
                const lastPoint = points[points.length - 2];
                const distance = map.distance(lastPoint, e.latlng);
                totalDistance += distance;

                const line = L.polyline([lastPoint, e.latlng], {
                    color: '#3b82f6',
                    weight: 3,
                    dashArray: '5, 10'
                }).addTo(map);
                lines.push(line);

                const midPoint = [
                    (lastPoint.lat + e.latlng.lat) / 2,
                    (lastPoint.lng + e.latlng.lng) / 2
                ];

                const distanceLabel = L.marker(midPoint, {
                    icon: L.divIcon({
                        className: 'distance-label',
                        html: `<div class="distance-text">${(distance / 1000).toFixed(2)} كم</div>`
                    })
                }).addTo(map);
                markers.push(distanceLabel);
            }
        });

        return {
            clear: () => {
                markers.forEach(m => map.removeLayer(m));
                lines.forEach(l => map.removeLayer(l));
                points = [];
                lines = [];
                markers = [];
                totalDistance = 0;
                map.off('click');
            },
            getDistance: () => totalDistance
        };
    },

    // Street View Simulation (محاكاة عرض الشارع)
    showStreetView(map, latlng) {
        const streetViewUrl = `https://maps.google.com/maps?q=&layer=c&cbll=${latlng.lat},${latlng.lng}&cbp=11,0,0,0,0`;
        
        L.popup()
            .setLatLng(latlng)
            .setContent(`
                <div style="width: 400px; height: 300px; font-family: 'Cairo';">
                    <iframe 
                        src="${streetViewUrl}"
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        style="border: 0; border-radius: 8px;"
                    ></iframe>
                    <div style="text-align: center; padding: 10px;">
                        <a href="https://www.google.com/maps/@${latlng.lat},${latlng.lng},3a,75y,90t/data=!3m4!1e1!3m2!1s!2e0" 
                           target="_blank"
                           style="color: #3b82f6; text-decoration: none; font-weight: 600;">
                            افتح في Google Maps 🔗
                        </a>
                    </div>
                </div>
            `)
            .openOn(map);
    },

    // Nearby Places Search (بحث الأماكن القريبة)
    async searchNearbyPlaces(center, type, radius = 2000) {
        const overpassUrl = 'https://overpass-api.de/api/interpreter';
        const query = `
            [out:json];
            (
                node["amenity"="${type}"](around:${radius},${center.lat},${center.lng});
            );
            out body;
        `;

        try {
            const response = await fetch(overpassUrl, {
                method: 'POST',
                body: query
            });
            const data = await response.json();
            return data.elements;
        } catch (error) {
            console.error('Overpass API Error:', error);
            return [];
        }
    },

    // Add POI Markers from Overpass
    async addPOIMarkers(map, center, category, icon, color) {
        const places = await this.searchNearbyPlaces(center, category, 3000);
        const markers = [];

        places.forEach(place => {
            const poiIcon = L.divIcon({
                className: 'poi-marker',
                html: `
                    <div class="poi-container" style="background: ${color};">
                        <span class="poi-icon">${icon}</span>
                    </div>
                `,
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            });

            const marker = L.marker([place.lat, place.lon], { icon: poiIcon })
                .bindPopup(`
                    <div class="premium-popup poi-popup">
                        <div class="popup-header" style="background: ${color};">
                            <span>${icon}</span>
                            <h3>${place.tags.name || 'بدون اسم'}</h3>
                        </div>
                        <div class="popup-body">
                            <div class="popup-item">
                                <span>📍</span>
                                <span>${place.tags['addr:full'] || 'غير محدد'}</span>
                            </div>
                        </div>
                    </div>
                `);

            markers.push(marker);
        });

        const cluster = L.markerClusterGroup();
        markers.forEach(m => cluster.addLayer(m));
        map.addLayer(cluster);

        return { markers, cluster };
    },

    // تطبيق فلاتر جمالية على الخريطة
    applyMapFilter(map, filterName) {
        const mapContainer = map.getContainer();
        
        // إزالة الفلاتر السابقة
        mapContainer.style.filter = '';
        mapContainer.classList.remove('map-vintage', 'map-cinematic', 'map-neon', 'map-warm', 'map-cool');
        
        switch(filterName) {
            case 'vintage':
                mapContainer.style.filter = 'sepia(0.3) contrast(1.1) brightness(1.05)';
                mapContainer.classList.add('map-vintage');
                break;
            case 'cinematic':
                mapContainer.style.filter = 'contrast(1.15) saturate(0.9) brightness(0.95)';
                mapContainer.classList.add('map-cinematic');
                break;
            case 'vibrant':
                mapContainer.style.filter = 'saturate(1.3) contrast(1.1) brightness(1.05)';
                break;
            case 'neon':
                mapContainer.style.filter = 'saturate(1.5) contrast(1.2) brightness(1.1) hue-rotate(10deg)';
                mapContainer.classList.add('map-neon');
                break;
            case 'warm':
                mapContainer.style.filter = 'sepia(0.15) saturate(1.2) brightness(1.05)';
                mapContainer.classList.add('map-warm');
                break;
            case 'cool':
                mapContainer.style.filter = 'hue-rotate(180deg) saturate(1.1)';
                mapContainer.classList.add('map-cool');
                break;
            case 'grayscale':
                mapContainer.style.filter = 'grayscale(1) contrast(1.1)';
                break;
            case 'none':
            default:
                mapContainer.style.filter = 'brightness(1.05) contrast(1.1)';
        }
    },

    // إضافة Vignette Effect (تظليل الأطراف)
    addVignette(map) {
        const mapContainer = map.getContainer();
        const vignette = document.createElement('div');
        vignette.className = 'map-vignette';
        mapContainer.appendChild(vignette);
    },

    // إضافة Grid Overlay (شبكة إرشادية)
    addGridOverlay(map) {
        const gridSVG = `
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; pointer-events: none; z-index: 400;">
                <defs>
                    <pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse">
                        <path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(59, 130, 246, 0.1)" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        `;
        
        const gridContainer = document.createElement('div');
        gridContainer.innerHTML = gridSVG;
        gridContainer.className = 'map-grid-overlay';
        map.getContainer().appendChild(gridContainer);
        
        return gridContainer;
    },

    // إضافة Animated Particles (جزيئات متحركة)
    addParticleEffect(map) {
        const canvas = document.createElement('canvas');
        canvas.className = 'particle-canvas';
        canvas.width = map.getContainer().offsetWidth;
        canvas.height = map.getContainer().offsetHeight;
        
        map.getContainer().appendChild(canvas);
        const ctx = canvas.getContext('2d');
        
        const particles = [];
        for (let i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                size: Math.random() * 2 + 1
            });
        }
        
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(59, 130, 246, 0.3)';
            
            particles.forEach(p => {
                p.x += p.vx;
                p.y += p.vy;
                
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
                
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fill();
            });
            
            requestAnimationFrame(animate);
        }
        
        animate();
        return canvas;
    },

    // Compass Rose (بوصلة جمالية)
    addCompassRose(map) {
        const compassHTML = `
            <div class="compass-rose">
                <div class="compass-needle"></div>
                <div class="compass-directions">
                    <span class="compass-n">N<br>شمال</span>
                    <span class="compass-e">E<br>شرق</span>
                    <span class="compass-s">S<br>جنوب</span>
                    <span class="compass-w">W<br>غرب</span>
                </div>
            </div>
        `;
        
        const compass = document.createElement('div');
        compass.innerHTML = compassHTML;
        map.getContainer().appendChild(compass);
        
        // تحديث اتجاه البوصلة عند تدوير الخريطة
        map.on('rotate', function(e) {
            const needle = map.getContainer().querySelector('.compass-needle');
            if (needle) {
                needle.style.transform = `rotate(${-map.getBearing()}deg)`;
            }
        });
        
        return compass;
    },

    // Scale Bar جمالي مخصص
    addCustomScaleBar(map) {
        const scaleBar = L.control.scale({
            position: 'bottomright',
            maxWidth: 200,
            metric: true,
            imperial: false
        }).addTo(map);
        
        // تخصيص الشكل
        const scaleElement = map.getContainer().querySelector('.leaflet-control-scale');
        if (scaleElement) {
            scaleElement.style.cssText = `
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 8px;
                padding: 8px 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                border: 2px solid rgba(59, 130, 246, 0.2);
                font-family: 'Cairo', sans-serif;
                font-weight: 600;
            `;
        }
        
        return scaleBar;
    },

    // Mini Map (خريطة صغيرة للتنقل)
    addMiniMap(map) {
        const miniMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        });
        
        const miniMap = new L.Control.MiniMap(miniMapLayer, {
            toggleDisplay: true,
            minimized: false,
            position: 'bottomleft',
            width: 150,
            height: 150,
            zoomLevelOffset: -5
        }).addTo(map);
        
        return miniMap;
    },

    // إضافة Location Accuracy Circle (دائرة دقة الموقع)
    addAccuracyCircle(map, latlng, accuracy = 50) {
        return L.circle(latlng, {
            radius: accuracy,
            color: '#3b82f6',
            fillColor: '#3b82f6',
            fillOpacity: 0.1,
            weight: 2,
            dashArray: '5, 5',
            className: 'accuracy-circle'
        }).addTo(map);
    },

    // Animated Map Bounds (حدود متحركة)
    highlightBounds(map, bounds, color = '#3b82f6') {
        const rectangle = L.rectangle(bounds, {
            color: color,
            weight: 3,
            fillOpacity: 0.1,
            dashArray: '10, 5',
            className: 'animated-bounds'
        }).addTo(map);
        
        return rectangle;
    },

    // Glow Effect للخطوط
    addGlowPolyline(map, latlngs, color = '#3b82f6') {
        const glowLine = L.polyline(latlngs, {
            color: color,
            weight: 10,
            opacity: 0.3,
            smoothFactor: 1,
            className: 'glow-line'
        }).addTo(map);
        
        const mainLine = L.polyline(latlngs, {
            color: color,
            weight: 4,
            opacity: 0.9,
            smoothFactor: 1
        }).addTo(map);
        
        return { glow: glowLine, main: mainLine };
    }
};
</script>
