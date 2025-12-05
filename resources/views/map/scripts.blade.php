<script>
// ==================== البيانات ====================
window.MapDataStore = {
    emergencyServices: [],
    municipalProjects: [],
    roadStatus: [],
    roadConditions: {},
    heatmapTypes: [
        { id: 'accidents', name: 'الحوادث', icon: '⚠️', color: 'red' },
        { id: 'traffic', name: 'الازدحام', icon: '🚗', color: 'orange' },
        { id: 'maintenance', name: 'الصيانة', icon: '🚧', color: 'yellow' },
        { id: 'emergency', name: 'الطوارئ', icon: '🚨', color: 'red' },
        { id: 'schools', name: 'المدارس', icon: '🏫', color: 'blue' }
    ],
    heatmapData: {
        accidents: [
            // مناطق الحوادث المكثفة
            [24.7136, 46.6753, 1.0], [24.7236, 46.6853, 0.95], [24.7036, 46.6653, 0.9],
            [24.7150, 46.6780, 0.85], [24.7180, 46.6820, 0.92], [24.7120, 46.6720, 0.88],
            [24.7250, 46.6900, 0.95], [24.7080, 46.6600, 0.87], [24.7200, 46.6850, 0.90],
            [24.7160, 46.6760, 0.83], [24.7190, 46.6810, 0.91], [24.7110, 46.6690, 0.86],
            [24.7220, 46.6880, 0.94], [24.7050, 46.6620, 0.82], [24.7170, 46.6790, 0.89],
            [24.7130, 46.6740, 0.84], [24.7210, 46.6860, 0.93], [24.7070, 46.6640, 0.81],
            [24.7240, 46.6920, 0.96], [24.7090, 46.6610, 0.85]
        ],
        traffic: [
            // مناطق الازدحام المروري
            [24.7136, 46.6753, 1.0], [24.7150, 46.6770, 0.98], [24.7170, 46.6790, 0.95],
            [24.7140, 46.6760, 0.97], [24.7160, 46.6780, 0.96], [24.7130, 46.6740, 0.94],
            [24.7180, 46.6810, 0.99], [24.7120, 46.6720, 0.92], [24.7190, 46.6830, 0.98],
            [24.7110, 46.6700, 0.90], [24.7200, 46.6850, 1.0], [24.7100, 46.6680, 0.89],
            [24.7210, 46.6870, 0.97], [24.7090, 46.6660, 0.88], [24.7220, 46.6890, 0.96],
            [24.7080, 46.6640, 0.86], [24.7230, 46.6910, 0.95], [24.7070, 46.6620, 0.85],
            [24.7240, 46.6930, 0.94], [24.7060, 46.6600, 0.83], [24.7250, 46.6950, 0.93],
            [24.7155, 46.6775, 0.98], [24.7145, 46.6765, 0.96], [24.7165, 46.6785, 0.97]
        ],
        maintenance: [
            // مناطق الصيانة
            [24.7100, 46.6700, 1.0], [24.7120, 46.6720, 0.95], [24.7140, 46.6740, 0.92],
            [24.7110, 46.6710, 0.97], [24.7130, 46.6730, 0.94], [24.7090, 46.6690, 0.90],
            [24.7150, 46.6750, 0.98], [24.7080, 46.6680, 0.88], [24.7160, 46.6760, 0.96],
            [24.7070, 46.6670, 0.86], [24.7170, 46.6770, 0.93], [24.7060, 46.6660, 0.84],
            [24.7180, 46.6780, 0.91], [24.7050, 46.6650, 0.82], [24.7190, 46.6790, 0.89]
        ],
        emergency: [
            // مناطق الطوارئ
            [24.7236, 46.6853, 1.0], [24.7036, 46.6653, 0.98], [24.7336, 46.6953, 0.96],
            [24.7250, 46.6870, 0.99], [24.7050, 46.6670, 0.97], [24.7350, 46.6970, 0.95],
            [24.7220, 46.6840, 0.98], [24.7020, 46.6640, 0.96], [24.7320, 46.6940, 0.94],
            [24.7260, 46.6880, 1.0], [24.7060, 46.6680, 0.98], [24.7360, 46.6980, 0.96],
            [24.7240, 46.6860, 0.97], [24.7040, 46.6660, 0.95], [24.7340, 46.6960, 0.93]
        ],
        schools: [
            // مناطق المدارس
            [24.7200, 46.6800, 1.0], [24.7300, 46.6900, 0.95], [24.7400, 46.7000, 0.92],
            [24.7220, 46.6820, 0.98], [24.7320, 46.6920, 0.94], [24.7420, 46.7020, 0.90],
            [24.7180, 46.6780, 0.96], [24.7280, 46.6880, 0.93], [24.7380, 46.6980, 0.89],
            [24.7240, 46.6840, 0.97], [24.7340, 46.6940, 0.94], [24.7440, 46.7040, 0.91],
            [24.7160, 46.6760, 0.95], [24.7260, 46.6860, 0.92], [24.7360, 46.6960, 0.88],
            [24.7210, 46.6810, 0.96], [24.7310, 46.6910, 0.93], [24.7410, 46.7010, 0.90]
        ]
    },
    routeAlerts: [
        { id: 1, icon: '🚧', message: 'صيانة على طريق الملك فهد', class: 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' },
        { id: 2, icon: '🏫', message: 'مدرسة قريبة - قلل السرعة', class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800' }
    ]
};

// ==================== تحميل البيانات من API ====================
window.DataLoader = {
    async loadEmergencyServices() {
        try {
            const response = await fetch('/api/map/emergency-services');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            
            console.log('✅ Emergency Services loaded:', data.length);
            
            window.MapDataStore.emergencyServices = data.map(service => ({
                ...service,
                icon: this.getServiceIcon(service.type),
                bgClass: this.getServiceBgClass(service.type),
                status: service.is_open ? 'مفتوح الآن' : 'مغلق',
                statusClass: service.is_open ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300',
                queueCount: Math.floor(Math.random() * 20) + 1,
                waitTime: `${Math.floor(Math.random() * 45) + 5} دقيقة`,
                workingHours: service.working_hours,
                isOpen: service.is_open
            }));
            
            return data;
        } catch (error) {
            console.error('❌ Error loading emergency services:', error);
            window.MapDataStore.emergencyServices = [];
            return [];
        }
    },
    
    async loadMunicipalProjects() {
        try {
            const response = await fetch('/api/map/municipal-projects');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            
            console.log('✅ Municipal Projects loaded:', data.length);
            
            window.MapDataStore.municipalProjects = data.map(project => ({
                ...project,
                icon: this.getProjectIcon(project.type),
                statusBadge: this.getProjectStatusBadge(project.status)
            }));
            
            return data;
        } catch (error) {
            console.error('❌ Error loading municipal projects:', error);
            window.MapDataStore.municipalProjects = [];
            return [];
        }
    },
    
    async loadRoads() {
        try {
            const response = await fetch('/api/map/roads');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            
            console.log('✅ Roads loaded:', data.length);
            
            window.MapDataStore.roadStatus = data.map(road => ({
                ...road,
                icon: this.getRoadIcon(road.status),
                statusClass: this.getRoadStatusClass(road.status)
            }));
            
            // تحويل للـ roadConditions format
            window.MapDataStore.roadConditions = {};
            data.forEach(road => {
                window.MapDataStore.roadConditions[road.name] = {
                    status: road.status,
                    speed: road.speed || 50,
                    incidents: road.incidents || 0,
                    color: this.getRoadColor(road.status),
                    icon: this.getRoadIcon(road.status),
                    statusClass: this.getRoadStatusClass(road.status),
                    description: road.description || ''
                };
            });
            
            console.log('✅ Road Conditions:', Object.keys(window.MapDataStore.roadConditions));
            
            return data;
        } catch (error) {
            console.error('❌ Error loading roads:', error);
            window.MapDataStore.roadStatus = [];
            window.MapDataStore.roadConditions = {};
            return [];
        }
    },
    
    getServiceIcon(type) {
        const icons = {
            'hospital': '🏥',
            'ambulance': '🚑',
            'fire_station': '🚒',
            'police': '👮',
            'clinic': '🏥'
        };
        return icons[type] || '🏥';
    },
    
    getServiceBgClass(type) {
        const classes = {
            'hospital': 'bg-gradient-to-br from-red-100 to-pink-100',
            'ambulance': 'bg-gradient-to-br from-orange-100 to-red-100',
            'fire_station': 'bg-gradient-to-br from-red-100 to-yellow-100',
            'police': 'bg-gradient-to-br from-blue-100 to-indigo-100',
            'clinic': 'bg-gradient-to-br from-green-100 to-emerald-100'
        };
        return classes[type] || 'bg-gradient-to-br from-gray-100 to-slate-100';
    },
    
    getProjectIcon(type) {
        const icons = {
            'road': '🛣️',
            'park': '🌳',
            'lighting': '💡',
            'building': '🏗️'
        };
        return icons[type] || '🏗️';
    },
    
    getProjectStatusBadge(status) {
        const badges = {
            'in_progress': 'bg-blue-100 text-blue-700',
            'completed': 'bg-green-100 text-green-700',
            'planning': 'bg-yellow-100 text-yellow-700',
            'pending': 'bg-gray-100 text-gray-700'
        };
        return badges[status] || 'bg-gray-100 text-gray-700';
    },
    
    getRoadIcon(status) {
        const icons = {
            'clear': '✅',
            'moderate': '🚗',
            'congested': '🔴',
            'maintenance': '🚧'
        };
        return icons[status] || '🚗';
    },
    
    getRoadStatusClass(status) {
        const classes = {
            'clear': 'bg-green-100 text-green-700',
            'moderate': 'bg-yellow-100 text-yellow-700',
            'congested': 'bg-red-100 text-red-700',
            'maintenance': 'bg-orange-100 text-orange-700'
        };
        return classes[status] || 'bg-gray-100 text-gray-700';
    },
    
    getRoadColor(status) {
        const colors = {
            'clear': '#10b981',
            'moderate': '#f59e0b',
            'congested': '#ef4444',
            'maintenance': '#f97316'
        };
        return colors[status] || '#6b7280';
    },
    
    // إضافة دوال جديدة للبحث والإحصائيات
    async searchAll(query) {
        try {
            const response = await fetch(`/api/map/search?q=${encodeURIComponent(query)}`);
            if (!response.ok) throw new Error('Search failed');
            const data = await response.json();
            console.log('🔍 Search results:', data);
            return data.results || [];
        } catch (error) {
            console.error('❌ Search error:', error);
            return [];
        }
    },
    
    async loadStatistics() {
        try {
            const response = await fetch('/api/map/statistics');
            if (!response.ok) throw new Error('Statistics failed');
            const data = await response.json();
            console.log('📊 Statistics loaded:', data);
            return data;
        } catch (error) {
            console.error('❌ Statistics error:', error);
            return null;
        }
    }
};

// ==================== وظائف الخريطة ====================
window.MapFunctions = {
    initMap(userLocation) {
        return L.map('map', {
            center: [userLocation.lat, userLocation.lng],
            zoom: 13,
            zoomControl: true,
            minZoom: 5,
            maxZoom: 22
        });
    },
    
    loadMapTiles(map, provider) {
        let url = provider.url;
        if (provider.key) url = url.replace('{key}', provider.key);
        return L.tileLayer(url, {
            attribution: provider.attribution,
            crossOrigin: 'anonymous',
            ...provider.options
        }).addTo(map);
    },
    
    addUserMarker(map, lat, lng) {
        return L.marker([lat, lng], {
            icon: L.divIcon({
                className: 'custom-div-icon',
                html: '<div style="background: linear-gradient(135deg, #3b82f6, #2563eb); width: 24px; height: 24px; border-radius: 50%; border: 4px solid white; box-shadow: 0 4px 12px rgba(59,130,246,0.4);"></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            })
        }).addTo(map).bindPopup('<strong>📍 موقعك الحالي</strong>');
    },
    
    addServiceMarker(map, service, clickHandler) {
        const marker = L.marker([service.lat, service.lng], {
            icon: L.divIcon({
                className: 'custom-div-icon',
                html: `<div style="font-size: 32px; cursor: pointer;">${service.icon}</div>`,
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        }).addTo(map);
        marker.on('click', () => clickHandler(service));
        marker.bindPopup(`<div style="text-align: right; font-family: 'Cairo';"><strong>${service.icon} ${service.name}</strong><br><span style="font-size: 12px;">📍 ${service.address}</span></div>`);
        return marker;
    },
    
    addProjectMarker(map, project) {
        return L.marker([project.lat, project.lng], {
            icon: L.divIcon({
                className: 'custom-div-icon',
                html: `<div style="font-size: 28px;">${project.icon}</div>`,
                iconSize: [28, 28],
                iconAnchor: [14, 14]
            })
        }).addTo(map).bindPopup(`<div style="text-align: right;"><strong>${project.name}</strong><br>${project.location}</div>`);
    },
    
    addHeatmap(map, data, gradient) {
        return L.heatLayer(data, { 
            radius: 35,           // زيادة نصف القطر
            blur: 25,             // زيادة التمويه
            maxZoom: 17, 
            gradient: gradient,
            minOpacity: 0.4,      // زيادة الشفافية الدنيا
            max: 1.0              // الحد الأقصى للكثافة
        }).addTo(map);
    },
    
    createRoute(map, from, to) {
        return L.Routing.control({
            waypoints: [L.latLng(from.lat, from.lng), L.latLng(to.lat, to.lng)],
            routeWhileDragging: false,
            show: false,
            createMarker: () => null
        }).addTo(map);
    },
    
    // وظائف الخدمات الطارئة مع تحليل الطريق
    createRouteWithConditions(map, from, to, roadConditionsCallback) {
        const routingControl = L.Routing.control({
            waypoints: [L.latLng(from.lat, from.lng), L.latLng(to.lat, to.lng)],
            routeWhileDragging: false,
            show: false,
            createMarker: () => null
        }).addTo(map);

        routingControl.on('routesfound', function(e) {
            const routes = e.routes;
            const summary = routes[0].summary;
            const roadAnalysis = window.MapFunctions.analyzeRouteRoads(routes[0], to);
            
            if (roadConditionsCallback) {
                roadConditionsCallback(roadAnalysis, summary);
            }
        });

        return routingControl;
    },
    
    addCustomScaleBar(map) {
        return L.control.scale({
            position: 'bottomright',
            maxWidth: 200,
            metric: true,
            imperial: false
        }).addTo(map);
    },
    
    addAccuracyCircle(map, latlng, accuracy = 50) {
        return L.circle(latlng, {
            radius: accuracy,
            color: '#3b82f6',
            fillColor: '#3b82f6',
            fillOpacity: 0.1,
            weight: 2,
            dashArray: '5, 5'
        }).addTo(map);
    },
    
    createMarkerCluster(map) {
        return L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 50
        });
    },
    
    analyzeRouteRoads(route, destination) {
        const roadConditions = window.MapDataStore.roadConditions;
        const roadsInRoute = [];
        const possibleRoads = Object.keys(roadConditions);
        const selectedRoads = possibleRoads.slice(0, Math.floor(Math.random() * 3) + 1);
        
        selectedRoads.forEach(roadName => {
            roadsInRoute.push({ name: roadName, ...roadConditions[roadName] });
        });
        
        const avgSpeed = roadsInRoute.reduce((sum, road) => sum + road.speed, 0) / roadsInRoute.length;
        const totalIncidents = roadsInRoute.reduce((sum, road) => sum + road.incidents, 0);
        const overallStatus = this.determineOverallStatus(avgSpeed, totalIncidents);
        
        return {
            roads: roadsInRoute,
            averageSpeed: Math.round(avgSpeed),
            totalIncidents: totalIncidents,
            overallStatus: overallStatus,
            recommendation: this.getRouteRecommendation(overallStatus),
            destination: destination // إضافة معلومات الوجهة
        };
    },
    
    determineOverallStatus(avgSpeed, incidents) {
        if (incidents >= 3 || avgSpeed < 20) {
            return { status: 'سيء', color: '#ef4444', icon: '🔴', class: 'bg-red-100 text-red-700 border-red-300' };
        } else if (incidents >= 1 || avgSpeed < 50) {
            return { status: 'متوسط', color: '#f59e0b', icon: '🟡', class: 'bg-yellow-100 text-yellow-700 border-yellow-300' };
        } else {
            return { status: 'جيد', color: '#10b981', icon: '✅', class: 'bg-green-100 text-green-700 border-green-300' };
        }
    },
    
    getRouteRecommendation(overallStatus) {
        if (overallStatus.status === 'سيء') return 'يُنصح بالبحث عن طريق بديل أو الانتظار قليلاً';
        if (overallStatus.status === 'متوسط') return 'الطريق مقبول مع توقع بعض التأخير';
        return 'الطريق ممتاز - انطلق بأمان';
    },
    
    darkenColor(color) {
        const colors = { '#10b981': '#059669', '#f59e0b': '#d97706', '#ef4444': '#dc2626' };
        return colors[color] || color;
    },
    
    createRouteConditionPopup(analysis) {
        const roadsHTML = analysis.roads.map(road => `
            <div class="road-item-compact" style="display: flex; align-items: center; gap: 8px; padding: 10px; background: ${road.color}08; border: 2px solid ${road.color}30; border-radius: 10px; margin-bottom: 8px;">
                <span style="font-size: 24px;">${road.icon}</span>
                <div style="flex: 1;">
                    <div style="font-weight: 700; color: #1f2937; margin-bottom: 4px; font-size: 13px;">${road.name}</div>
                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 6px;">
                        <span style="font-size: 11px; padding: 3px 8px; border-radius: 12px; font-weight: 700; background: ${road.color}; color: white;">${road.status}</span>
                        <span style="font-size: 11px; color: #6b7280; background: #f9fafb; padding: 3px 8px; border-radius: 8px;">⚡${road.speed} كم/س</span>
                        ${road.incidents > 0 ? `<span style="font-size: 11px; color: white; background: #ef4444; padding: 3px 8px; border-radius: 8px;">⚠️${road.incidents}</span>` : ''}
                    </div>
                    <!-- شريط ازدحام الطريق -->
                    <div style="background: #f3f4f6; padding: 6px; border-radius: 6px; margin-top: 4px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;">
                            <span style="font-size: 9px; color: #6b7280; font-weight: 600;">ازدحام الطريق</span>
                            <span style="font-size: 10px; font-weight: 800; color: ${this.getTrafficCongestionColor(road.speed)};">${this.getTrafficCongestionLevel(road.speed)}</span>
                        </div>
                        <div style="height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden;">
                            <div style="height: 100%; background: ${this.getTrafficCongestionColor(road.speed)}; width: ${this.getTrafficCongestionPercentage(road.speed)}%; transition: width 0.5s ease;"></div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
        
        // حساب ازدحام الوجهة (المنشأة)
        const destinationCongestion = analysis.destination ? this.getDestinationCongestion(analysis.destination) : null;
        
        return `
            <div style="font-family: 'Cairo', sans-serif; text-align: right; width: 100%; background: white;">
                <div style="background: linear-gradient(135deg, ${analysis.overallStatus.color}, ${this.darkenColor(analysis.overallStatus.color)}); padding: 15px; border-radius: 12px 12px 0 0; margin: -60px -16px 15px -16px;">
                    <h3 style="margin: 0; color: white; font-size: 16px; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 28px;">🛣️</span>
                        <span>تحليل المسار والوجهة</span>
                    </h3>
                </div>
                
                <div style="padding: 0 5px;">
                    <!-- ازدحام المنشأة (الوجهة) -->
                    ${analysis.destination ? `
                        <div style="background: linear-gradient(135deg, ${destinationCongestion.color}15, ${destinationCongestion.color}25); border: 2px solid ${destinationCongestion.color}; border-radius: 12px; padding: 12px; margin-bottom: 15px;">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                <span style="font-size: 28px;">${analysis.destination.icon}</span>
                                <div style="flex: 1;">
                                    <div style="font-size: 12px; color: #6b7280; margin-bottom: 2px; font-weight: 600;">حالة الوجهة</div>
                                    <div style="font-size: 14px; font-weight: 800; color: #1f2937;">${analysis.destination.name}</div>
                                </div>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 10px;">
                                <div style="background: white; padding: 8px; border-radius: 8px; text-align: center; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 9px; color: #6b7280; margin-bottom: 3px; font-weight: 600;">عدد المنتظرين</div>
                                    <div style="font-size: 18px; font-weight: 800; color: ${destinationCongestion.color};">${analysis.destination.queueCount}</div>
                                </div>
                                <div style="background: white; padding: 8px; border-radius: 8px; text-align: center; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 9px; color: #6b7280; margin-bottom: 3px; font-weight: 600;">وقت الانتظار</div>
                                    <div style="font-size: 18px; font-weight: 800; color: ${destinationCongestion.color};">${analysis.destination.waitTime}</div>
                                </div>
                            </div>
                            
                            <!-- شريط ازدحام المنشأة -->
                            <div style="background: white; padding: 8px; border-radius: 8px; border: 1px solid #e5e7eb;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                    <span style="font-size: 10px; color: #6b7280; font-weight: 700;">مستوى الازدحام</span>
                                    <span style="font-size: 11px; font-weight: 800; color: ${destinationCongestion.color};">${destinationCongestion.level}</span>
                                </div>
                                <div style="height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                    <div style="height: 100%; background: ${destinationCongestion.color}; width: ${destinationCongestion.percentage}%; transition: width 0.5s ease; box-shadow: 0 0 10px ${destinationCongestion.color}40;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 4px;">
                                    <span style="font-size: 8px; color: #6b7280;">فارغ</span>
                                    <span style="font-size: 8px; color: #6b7280;">مزدحم جداً</span>
                                </div>
                            </div>
                            
                            <!-- توصية خاصة بالمنشأة -->
                            <div style="margin-top: 8px; padding: 8px; background: ${destinationCongestion.color}10; border-radius: 6px; border-right: 3px solid ${destinationCongestion.color};">
                                <div style="font-size: 10px; color: ${destinationCongestion.color}; font-weight: 700;">💡 ${destinationCongestion.recommendation}</div>
                            </div>
                        </div>
                    ` : ''}
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
                        <div style="padding: 12px; background: linear-gradient(135deg, ${analysis.overallStatus.color}15, ${analysis.overallStatus.color}25); border: 2px solid ${analysis.overallStatus.color}; border-radius: 10px; text-align: center;">
                            <div style="font-size: 10px; color: #6b7280; margin-bottom: 5px; font-weight: 700;">حالة الطريق</div>
                            <div style="font-size: 18px; font-weight: 800; color: ${analysis.overallStatus.color};">
                                <span style="font-size: 24px;">${analysis.overallStatus.icon}</span>
                                <span style="font-size: 14px;">${analysis.overallStatus.status}</span>
                            </div>
                        </div>
                        <div style="padding: 12px; background: linear-gradient(135deg, #f9fafb, #f3f4f6); border: 2px solid #d1d5db; border-radius: 10px; text-align: center;">
                            <div style="font-size: 10px; color: #6b7280; margin-bottom: 5px; font-weight: 700;">متوسط السرعة</div>
                            <div style="font-size: 18px; font-weight: 800; color: #1f2937;">
                                <span>${analysis.averageSpeed}</span>
                                <span style="font-size: 11px;">كم/س</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <h4 style="font-size: 12px; font-weight: 800; color: #1f2937; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                            <span style="width: 3px; height: 16px; background: linear-gradient(180deg, #3b82f6, #2563eb); border-radius: 2px;"></span>
                            <span>الطرق في مسارك</span>
                        </h4>
                        ${roadsHTML}
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); padding: 12px; border-radius: 10px; border-right: 4px solid #3b82f6; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: #1e40af; margin-bottom: 5px; font-weight: 800; display: flex; align-items: center; gap: 4px;">
                            <span style="font-size: 16px;">💡</span>
                            <span>توصية عامة</span>
                        </div>
                        <div style="font-size: 12px; color: #1f2937; font-weight: 700; line-height: 1.5;">${analysis.recommendation}</div>
                    </div>
                    
                    ${analysis.totalIncidents > 0 ? `
                        <div style="padding: 10px; background: linear-gradient(135deg, #fef2f2, #fee2e2); border: 2px solid #fecaca; border-radius: 10px; margin-bottom: 12px;">
                            <div style="font-size: 11px; color: #dc2626; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                                <span style="font-size: 18px;">⚠️</span>
                                <span>تنبيه: ${analysis.totalIncidents} ${analysis.totalIncidents === 1 ? 'حادث' : 'حوادث'} على الطريق</span>
                            </div>
                        </div>
                    ` : ''}
                    
                    <button class="start-navigation-btn" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 10px; font-size: 13px; font-weight: 800; cursor: pointer; font-family: 'Cairo'; box-shadow: 0 4px 12px rgba(59,130,246,0.4); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(59,130,246,0.5)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.4)';">
                        ✓ ابدأ الملاحة الآن
                    </button>
                </div>
            </div>
        `;
    },
    
    showRouteConditionOnMap(map, roadAnalysis) {
        map.closePopup();
        
        const servicePanel = document.querySelector('.service-details-panel');
        if (servicePanel) {
            servicePanel.style.display = 'none';
        }
        
        const existingPopupOverlay = document.querySelector('.route-popup-overlay-container');
        if (existingPopupOverlay) {
            existingPopupOverlay.remove();
        }
        
        let backdrop = document.querySelector('.popup-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'popup-backdrop';
            document.body.appendChild(backdrop);
        }
        
        setTimeout(() => backdrop.classList.add('active'), 10);
        document.body.classList.add('popup-active');
        
        const popupContainer = document.createElement('div');
        popupContainer.className = 'route-popup-overlay-container';
        popupContainer.innerHTML = this.createRouteConditionPopup(roadAnalysis);
        
        const closeButton = document.createElement('button');
        closeButton.className = 'route-popup-close-btn';
        closeButton.innerHTML = '✕';
        closeButton.onclick = () => {
            popupContainer.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.classList.remove('popup-active');
            setTimeout(() => {
                popupContainer.remove();
                backdrop.remove();
                if (servicePanel) {
                    servicePanel.style.display = 'block';
                }
            }, 300);
        };
        popupContainer.insertBefore(closeButton, popupContainer.firstChild);
        
        document.body.appendChild(popupContainer);
        setTimeout(() => popupContainer.classList.add('active'), 10);
        
        // ربط زر الملاحة
        setTimeout(() => {
            const navBtn = popupContainer.querySelector('.start-navigation-btn');
            if (navBtn) {
                navBtn.onclick = () => {
                    closeButton.click();
                };
            }
        }, 100);
        
        backdrop.addEventListener('click', () => {
            closeButton.click();
        });
        
        return popupContainer;
    },
    
    // دوال مساعدة لحساب الازدحام
    getTrafficCongestionLevel(speed) {
        if (speed >= 70) return 'سالك';
        if (speed >= 50) return 'خفيف';
        if (speed >= 30) return 'متوسط';
        if (speed >= 15) return 'شديد';
        return 'مختنق';
    },
    
    getTrafficCongestionColor(speed) {
        if (speed >= 70) return '#10b981';
        if (speed >= 50) return '#84cc16';
        if (speed >= 30) return '#f59e0b';
        if (speed >= 15) return '#ef4444';
        return '#dc2626';
    },
    
    getTrafficCongestionPercentage(speed) {
        if (speed >= 70) return 20;
        if (speed >= 50) return 40;
        if (speed >= 30) return 60;
        if (speed >= 15) return 80;
        return 95;
    },
    
    getDestinationCongestion(destination) {
        const queueCount = destination.queueCount || 0;
        
        if (queueCount <= 5) {
            return {
                level: 'قليل جداً',
                color: '#10b981',
                percentage: 20,
                recommendation: 'الوضع ممتاز - لا توجد فترة انتظار تقريباً'
            };
        } else if (queueCount <= 10) {
            return {
                level: 'قليل',
                color: '#84cc16',
                percentage: 35,
                recommendation: 'الوضع جيد - وقت انتظار قصير'
            };
        } else if (queueCount <= 15) {
            return {
                level: 'متوسط',
                color: '#f59e0b',
                percentage: 55,
                recommendation: 'يُنصح بالحجز المسبق إن أمكن'
            };
        } else if (queueCount <= 20) {
            return {
                level: 'كثير',
                color: '#ef4444',
                percentage: 75,
                recommendation: 'انتظر وقت طويل - فكر في البدائل'
            };
        } else {
            return {
                level: 'مزدحم جداً',
                color: '#dc2626',
                percentage: 95,
                recommendation: 'وقت الانتظار طويل جداً - يُفضل الذهاب لاحقاً'
            };
        }
    },
    
    // تحديث دالة analyzeRouteRoads لتضمين معلومات الوجهة
    analyzeRouteRoads(route, destination) {
        const roadConditions = window.MapDataStore.roadConditions;
        const roadsInRoute = [];
        const possibleRoads = Object.keys(roadConditions);
        const selectedRoads = possibleRoads.slice(0, Math.floor(Math.random() * 3) + 1);
        
        selectedRoads.forEach(roadName => {
            roadsInRoute.push({ name: roadName, ...roadConditions[roadName] });
        });
        
        const avgSpeed = roadsInRoute.reduce((sum, road) => sum + road.speed, 0) / roadsInRoute.length;
        const totalIncidents = roadsInRoute.reduce((sum, road) => sum + road.incidents, 0);
        const overallStatus = this.determineOverallStatus(avgSpeed, totalIncidents);
        
        return {
            roads: roadsInRoute,
            averageSpeed: Math.round(avgSpeed),
            totalIncidents: totalIncidents,
            overallStatus: overallStatus,
            recommendation: this.getRouteRecommendation(overallStatus),
            destination: destination // إضافة معلومات الوجهة
        };
    },
    
    // تحديث createRouteWithConditions لتمرير معلومات الوجهة
    createRouteWithConditions(map, from, to, roadConditionsCallback) {
        const routingControl = L.Routing.control({
            waypoints: [L.latLng(from.lat, from.lng), L.latLng(to.lat, to.lng)],
            routeWhileDragging: false,
            show: false,
            createMarker: () => null
        }).addTo(map);

        routingControl.on('routesfound', function(e) {
            const routes = e.routes;
            const summary = routes[0].summary;
            const roadAnalysis = window.MapFunctions.analyzeRouteRoads(routes[0], to);
            
            if (roadConditionsCallback) {
                roadConditionsCallback(roadAnalysis, summary);
            }
        });

        return routingControl;
    }
}; // ✅ إغلاق window.MapFunctions هنا

// ==================== وظائف الخدمات ====================
window.ServiceFunctions = {
    searchServices(query, services, projects) {
        if (query.length < 2) return [];
        const results = services.filter(s => s.name.includes(query) || s.address.includes(query)).map(s => ({ ...s, type: 'service' }));
        const projectResults = projects.filter(p => p.name.includes(query) || p.location.includes(query)).map(p => ({ ...p, type: 'project', address: p.location }));
        return [...results, ...projectResults].slice(0, 5);
    },
    
    getQueueStatus(count) {
        if (!count) return null;
        if (count <= 5) return { text: 'ازدحام خفيف', class: 'bg-green-100 text-green-700' };
        if (count <= 15) return { text: 'ازدحام متوسط', class: 'bg-yellow-100 text-yellow-700' };
        return { text: 'ازدحام شديد', class: 'bg-red-100 text-red-700' };
    },
    
    getHeatmapGradient(type) {
        const gradients = {
            accidents: { 
                0.0: 'rgba(0, 0, 255, 0)',
                0.2: 'rgba(0, 255, 255, 0.3)',
                0.4: 'rgba(0, 255, 0, 0.5)',
                0.6: 'rgba(255, 255, 0, 0.7)',
                0.8: 'rgba(255, 165, 0, 0.85)',
                1.0: 'rgba(255, 0, 0, 1)'
            },
            traffic: { 
                0.0: 'rgba(0, 255, 0, 0)',
                0.3: 'rgba(0, 255, 0, 0.4)',
                0.5: 'rgba(255, 255, 0, 0.6)',
                0.7: 'rgba(255, 165, 0, 0.8)',
                0.9: 'rgba(255, 0, 0, 0.95)',
                1.0: 'rgba(139, 0, 0, 1)'
            },
            maintenance: { 
                0.0: 'rgba(0, 0, 255, 0)',
                0.3: 'rgba(0, 150, 255, 0.4)',
                0.5: 'rgba(255, 255, 0, 0.6)',
                0.7: 'rgba(255, 165, 0, 0.8)',
                1.0: 'rgba(255, 100, 0, 1)'
            },
            emergency: { 
                0.0: 'rgba(255, 192, 203, 0)',
                0.3: 'rgba(255, 105, 180, 0.5)',
                0.6: 'rgba(255, 0, 100, 0.7)',
                0.8: 'rgba(220, 20, 60, 0.9)',
                1.0: 'rgba(139, 0, 0, 1)'
            },
            schools: { 
                0.0: 'rgba(135, 206, 250, 0)',
                0.4: 'rgba(65, 105, 225, 0.5)',
                0.7: 'rgba(0, 0, 255, 0.7)',
                0.9: 'rgba(0, 0, 139, 0.9)',
                1.0: 'rgba(25, 25, 112, 1)'
            }
        };
        return gradients[type] || gradients.traffic;
    }
};

// ==================== وظائف الواجهة ====================
window.UIFunctions = {
    showNotification(notifications, notification) {
        const id = Date.now();
        notifications.push({ id, ...notification });
        setTimeout(() => {
            const index = notifications.findIndex(n => n.id === id);
            if (index !== -1) {
                notifications.splice(index, 1);
            }
        }, 5000);
    },
    
    useGPS(successCallback, errorCallback) {
        if (!navigator.geolocation) {
            errorCallback('متصفحك لا يدعم تحديد المواقع');
            return;
        }
        
        navigator.geolocation.getCurrentPosition(
            (position) => {
                successCallback(position.coords.latitude, position.coords.longitude);
            },
            (error) => {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errorCallback('تم رفض إذن الوصول إلى الموقع');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorCallback('تعذر الحصول على موقعك الحالي');
                        break;
                    case error.TIMEOUT:
                        errorCallback('انتهت مهلة تحديد الموقع');
                        break;
                    default:
                        errorCallback('حدث خطأ غير معروف أثناء تحديد الموقع');
                        break;
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }
};

// ==================== Real-time Updates ====================
window.RealtimeManager = {
    updateInterval: null,
    isActive: false,
    
    start(updateCallback, intervalMs = 30000) {
        if (this.isActive) return;
        
        this.isActive = true;
        console.log('🔄 Real-time updates started');
        
        this.updateInterval = _setInterval(async () => {
            try {
                const response = await fetch('/api/map/live-updates');
                if (!response.ok) throw new Error('Live updates failed');
                
                const data = await response.json();
                console.log('📡 Live update received:', data);
                
                if (updateCallback) {
                    updateCallback(data);
                }
            } catch (error) {
                console.error('❌ Live update error:', error);
            }
        }, intervalMs);
    },
    
    stop() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
            this.updateInterval = null;
            this.isActive = false;
            console.log('🛑 Real-time updates stopped');
        }
    }
};

// ==================== Notification Manager ====================
window.NotificationManager = {
    permission: 'default',
    
    async requestPermission() {
        if ('Notification' in window) {
            this.permission = await Notification.requestPermission();
            return this.permission === 'granted';
        }
        return false;
    },
    
    show(title, options = {}) {
        if (this.permission === 'granted' && 'Notification' in window) {
            const notification = new Notification(title, {
                icon: '/images/logo.png',
                badge: '/images/badge.png',
                dir: 'rtl',
                lang: 'ar',
                ...options
            });
            
            notification.onclick = () => {
                window.focus();
                notification.close();
            };
            
            return notification;
        }
        return null;
    }
};

// ==================== Vue App ====================
const { createApp } = Vue;

// حفظ setTimeout الأصلي
const _setTimeout = window.setTimeout;
const _clearTimeout = window.clearTimeout;

createApp({
    data() {
        return {
            map: null,
            userLocation: { lat: 24.7136, lng: 46.6753 },
            usingGPS: false,
            searchQuery: '',
            showSearchResults: false,
            searchResults: [],
            showEmergencyServices: false,
            selectedServiceDetails: null,
            showProjects: false,
            currentRoute: null,
            activeHeatmap: null,
            heatmapLayers: {},
            notifications: [],
            showMapStyles: false,
            currentMapProvider: 'osm',
            isDarkTheme: false,
            currentRouteAnalysis: null,
            emergencyServices: window.MapDataStore.emergencyServices,
            municipalProjects: window.MapDataStore.municipalProjects,
            roadStatus: window.MapDataStore.roadStatus,
            heatmapTypes: window.MapDataStore.heatmapTypes,
            heatmapData: window.MapDataStore.heatmapData,
            routeAlerts: window.MapDataStore.routeAlerts,
            mapProviders: {
                osm: {
                    name: 'OpenStreetMap',
                    url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    attribution: '© OpenStreetMap',
                    options: { maxZoom: 19, tileSize: 256, zoomOffset: 0 }
                },
                maptiler: {
                    name: 'MapTiler',
                    url: 'https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key={key}',
                    attribution: '© MapTiler',
                    key: 'FTEwYIdJtQUe56EPWul2',
                    options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
                }
            },
            availableMapStyles: [
                { id: 'osm', name: 'أساسي', icon: '🌍' },
                { id: 'maptiler', name: 'MapTiler', icon: '🗺️' }
            ],
            isLoading: true,
            loadingMessage: 'جاري التهيئة...',
            loadingProgress: 0,
            showStatistics: false,
            statistics: {
                total_services: 0,
                total_projects: 0,
                total_roads: 0
            },
            searchTimeout: null,
            realtimeEnabled: false,
            notificationsEnabled: false,
            lastUpdate: null
        };
    },
    
    async mounted() {
        try {
            console.log('🚀 Starting data loading...');
            
            // تحميل البيانات من API
            this.loadingMessage = 'جاري تحميل خدمات الطوارئ...';
            this.loadingProgress = 25;
            await window.DataLoader.loadEmergencyServices();
            
            this.loadingMessage = 'جاري تحميل المشاريع البلدية...';
            this.loadingProgress = 50;
            await window.DataLoader.loadMunicipalProjects();
            
            this.loadingMessage = 'جاري تحميل حالة الطرق...';
            this.loadingProgress = 75;
            await window.DataLoader.loadRoads();
            
            // تحديث البيانات في Vue
            this.emergencyServices = window.MapDataStore.emergencyServices;
            this.municipalProjects = window.MapDataStore.municipalProjects;
            this.roadStatus = window.MapDataStore.roadStatus;
            
            console.log('✅ Data loaded successfully:', {
                emergencyServices: this.emergencyServices.length,
                municipalProjects: this.municipalProjects.length,
                roadStatus: this.roadStatus.length
            });
            
            this.loadingMessage = 'جاري تهيئة الخريطة...';
            this.loadingProgress = 90;
            
            // تهيئة الخريطة
            await this.$nextTick();
            this.initMap();
            this.loadAllMarkers();
            
            this.loadingProgress = 100;
            this.isLoading = false;
            
            console.log('✅ Map initialized successfully!');
            
            document.addEventListener('click', this.handleClickOutside);
            
            // طلب إذن الإشعارات
            const notificationGranted = await window.NotificationManager.requestPermission();
            this.notificationsEnabled = notificationGranted;
            
            if (notificationGranted) {
                console.log('✅ Notifications enabled');
            }
            
            // بدء التحديثات اللحظية
            this.startRealtimeUpdates();
            
        } catch (error) {
            console.error('❌ Error during initialization:', error);
            this.isLoading = false;
            window.UIFunctions.showNotification(this.notifications, {
                title: 'خطأ في التحميل',
                message: 'حدث خطأ أثناء تحميل البيانات',
                icon: '❌',
                class: 'bg-gradient-to-r from-red-100 to-pink-100 text-red-900'
            });
        }
    },
    
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
        window.RealtimeManager.stop();
    },
    
    methods: {
        initMap() {
            this.map = window.MapFunctions.initMap(this.userLocation);
            window.MapFunctions.loadMapTiles(this.map, this.mapProviders[this.currentMapProvider]);
            window.MapFunctions.addUserMarker(this.map, this.userLocation.lat, this.userLocation.lng);
            window.MapFunctions.addCustomScaleBar(this.map);
            window.MapFunctions.addAccuracyCircle(this.map, [this.userLocation.lat, this.userLocation.lng], 100);
        },
        
        loadAllMarkers() {
            this.emergencyServices.forEach(service => {
                window.MapFunctions.addServiceMarker(this.map, service, (s) => this.showServiceDetails(s));
            });
            this.municipalProjects.forEach(project => {
                window.MapFunctions.addProjectMarker(this.map, project);
            });
        },
        
        async performSearch() {
            // استخدام setTimeout المحفوظ
            if (this.searchTimeout) {
                _clearTimeout(this.searchTimeout);
            }
            
            this.searchTimeout = _setTimeout(async () => {
                if (this.searchQuery.length >= 2) {
                    try {
                        this.searchResults = await window.DataLoader.searchAll(this.searchQuery);
                        this.showSearchResults = this.searchResults.length > 0;
                    } catch (error) {
                        console.error('Search error:', error);
                        this.searchResults = [];
                        this.showSearchResults = false;
                    }
                } else {
                    this.searchResults = [];
                    this.showSearchResults = false;
                }
            }, 300);
        },
        
        async loadStatistics() {
            try {
                const stats = await window.DataLoader.loadStatistics();
                if (stats) {
                    this.statistics = stats;
                }
            } catch (error) {
                console.error('Statistics error:', error);
            }
        },
        
        toggleStatistics() {
            this.showStatistics = !this.showStatistics;
            if (this.showStatistics) {
                this.loadStatistics();
            }
        },
        
        selectDestination(result) {
            this.showSearchResults = false;
            this.map.setView([result.lat, result.lng], 15);
            if (result.type === 'service') this.showServiceDetails(result);
        },
        
        showServiceDetails(service) {
            this.selectedServiceDetails = {
                ...service,
                queueStatus: window.ServiceFunctions.getQueueStatus(service.queueCount)
            };
        },
        
        closeServiceDetails() {
            this.selectedServiceDetails = null;
        },
        
        useGPSLocation() {
            this.usingGPS = true;
            window.UIFunctions.useGPS(
                (lat, lng) => {
                    this.userLocation = { lat, lng };
                    this.map.setView([lat, lng], 15);
                    this.usingGPS = false;
                    window.UIFunctions.showNotification(this.notifications, {
                        title: 'تم تحديد موقعك',
                        message: 'تم تحديث الموقع بنجاح',
                        icon: '📍',
                        class: 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-900'
                    });
                },
                (error) => {
                    this.usingGPS = false;
                    window.UIFunctions.showNotification(this.notifications, {
                        title: 'خطأ',
                        message: error,
                        icon: '❌',
                        class: 'bg-gradient-to-r from-red-100 to-pink-100 text-red-900'
                    });
                }
            );
        },
        
        toggleHeatmap(id) {
            if (this.activeHeatmap === id) {
                this.clearAllHeatmaps();
                return;
            }
            this.clearAllHeatmaps();
            this.activeHeatmap = id;
            const gradient = window.ServiceFunctions.getHeatmapGradient(id);
            this.heatmapLayers[id] = window.MapFunctions.addHeatmap(this.map, this.heatmapData[id], gradient);
            window.UIFunctions.showNotification(this.notifications, {
                title: 'تم تفعيل الخريطة الحرارية',
                message: this.heatmapTypes.find(h => h.id === id).name,
                icon: this.heatmapTypes.find(h => h.id === id).icon,
                class: 'bg-gradient-to-r from-purple-100 to-pink-100 text-purple-900'
            });
        },
        
        clearAllHeatmaps() {
            Object.values(this.heatmapLayers).forEach(layer => this.map.removeLayer(layer));
            this.heatmapLayers = {};
            this.activeHeatmap = null;
        },
        
        switchMapProvider(provider) {
            if (this.currentMapProvider === provider) return;
            this.currentMapProvider = provider;
            this.map.eachLayer((layer) => {
                if (layer instanceof L.TileLayer) this.map.removeLayer(layer);
            });
            window.MapFunctions.loadMapTiles(this.map, this.mapProviders[provider]);
        },
        
        navigateToService(service) {
            this.showEmergencyServices = false;
            this.selectedServiceDetails = null;
            
            if (this.currentRoute) this.map.removeControl(this.currentRoute);
            
            this.currentRoute = window.MapFunctions.createRouteWithConditions(
                this.map, 
                this.userLocation, 
                service,
                (roadAnalysis, summary) => {
                    this.currentRouteAnalysis = roadAnalysis;
                    setTimeout(() => {
                        window.MapFunctions.showRouteConditionOnMap(this.map, roadAnalysis);
                    }, 800);
                    window.UIFunctions.showNotification(this.notifications, {
                        title: `الطريق ${roadAnalysis.overallStatus.status}`,
                        message: roadAnalysis.recommendation,
                        icon: roadAnalysis.overallStatus.icon,
                        class: `bg-gradient-to-r ${roadAnalysis.overallStatus.class.includes('red') ? 'from-red-100 to-pink-100 text-red-900' : roadAnalysis.overallStatus.class.includes('yellow') ? 'from-yellow-100 to-orange-100 text-yellow-900' : 'from-green-100 to-emerald-100 text-green-900'}`
                    });
                }
            );
            
            window.UIFunctions.showNotification(this.notifications, {
                title: 'جاري حساب المسار',
                message: `المسار إلى ${service.name}`,
                icon: '🧭',
                class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-900'
            });
        },
        
        startNavigationTo(service) {
            this.navigateToService(service);
            this.closeServiceDetails();
        },
        
        removeNotification(id) {
            this.notifications = this.notifications.filter(n => n.id !== id);
        },
        
        handleClickOutside(event) {
            const mapStylesButton = event.target.closest('[title="اختر نمط الخريطة"]');
            const mapStylesDropdown = event.target.closest('.absolute.top-full');
            if (!mapStylesButton && !mapStylesDropdown && this.showMapStyles) {
                this.showMapStyles = false;
            }
        },
        
        startRealtimeUpdates() {
            window.RealtimeManager.start((data) => {
                this.handleLiveUpdate(data);
            }, 30000); // كل 30 ثانية
            
            this.realtimeEnabled = true;
        },
        
        stopRealtimeUpdates() {
            window.RealtimeManager.stop();
            this.realtimeEnabled = false;
        },
        
        toggleRealtimeUpdates() {
            if (this.realtimeEnabled) {
                this.stopRealtimeUpdates();
            } else {
                this.startRealtimeUpdates();
            }
        },
        
        handleLiveUpdate(data) {
            this.lastUpdate = new Date();
            
            // تحديث حالة الطرق
            if (data.road_updates) {
                const roadUpdate = data.road_updates;
                console.log('🛣️ Road update:', roadUpdate);
                
                // تحديث roadConditions
                if (window.MapDataStore.roadConditions[roadUpdate.road]) {
                    window.MapDataStore.roadConditions[roadUpdate.road].status = roadUpdate.status;
                    window.MapDataStore.roadConditions[roadUpdate.road].speed = roadUpdate.speed;
                    window.MapDataStore.roadConditions[roadUpdate.road].incidents = roadUpdate.incidents;
                }
                
                // إشعار
                window.UIFunctions.showNotification(this.notifications, {
                    title: 'تحديث حالة الطريق',
                    message: `${roadUpdate.road}: ${this.getRoadStatusText(roadUpdate.status)}`,
                    icon: '🛣️',
                    class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-900'
                });
            }
            
            // معالجة التنبيهات
            if (data.alerts && data.alerts.length > 0) {
                data.alerts.forEach(alert => {
                    this.showAlert(alert);
                });
            }
        },
        
        showAlert(alert) {
            // إشعار في التطبيق
            window.UIFunctions.showNotification(this.notifications, {
                title: 'تنبيه جديد',
                message: alert.message,
                icon: alert.icon,
                class: alert.priority === 'high' ? 
                    'bg-gradient-to-r from-red-100 to-pink-100 text-red-900' :
                    alert.priority === 'medium' ?
                    'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-900' :
                    'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-900'
            });
            
            // إشعار النظام
            if (this.notificationsEnabled && alert.priority === 'high') {
                window.NotificationManager.show('تنبيه مهم', {
                    body: alert.message,
                    tag: 'alert-' + Date.now(),
                    requireInteraction: true
                });
            }
        },
        
        getRoadStatusText(status) {
            const statusMap = {
                'clear': 'سالك',
                'moderate': 'ازدحام متوسط',
                'congested': 'ازدحام شديد',
                'maintenance': 'صيانة'
            };
            return statusMap[status] || status;
        },
        
        async refreshAllData() {
            try {
                this.isLoading = true;
                this.loadingMessage = 'جاري تحديث البيانات...';
                
                // مسح الذاكرة المؤقتة
                await fetch('/api/map/clear-cache', { method: 'POST' });
                
                // إعادة تحميل كل شيء
                await window.DataLoader.loadEmergencyServices();
                await window.DataLoader.loadMunicipalProjects();
                await window.DataLoader.loadRoads();
                
                this.emergencyServices = window.MapDataStore.emergencyServices;
                this.municipalProjects = window.MapDataStore.municipalProjects;
                this.roadStatus = window.MapDataStore.roadStatus;
                
                // إعادة تحميل الماركرات
                this.map.eachLayer(layer => {
                    if (layer instanceof L.Marker) {
                        this.map.removeLayer(layer);
                    }
                });
                
                this.loadAllMarkers();
                
                this.isLoading = false;
                
                window.UIFunctions.showNotification(this.notifications, {
                    title: 'تم التحديث',
                    message: 'تم تحديث جميع البيانات بنجاح',
                    icon: '✅',
                    class: 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-900'
                });
                
            } catch (error) {
                this.isLoading = false;
                console.error('Refresh error:', error);
            }
        }
    }
}).mount('#mapApp');
</script>
