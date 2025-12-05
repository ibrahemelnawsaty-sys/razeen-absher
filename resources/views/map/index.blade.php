<script>
// ==================== البيانات ====================
window.MapDataStore = {
    emergencyServices: [
        {
            id: 1,
            name: 'مستشفى الملك فهد الجامعي',
            address: 'طريق الملك فهد، حي الياسمين، شمال الرياض',
            phone: '920012345',
            icon: '🏥',
            bgClass: 'bg-gradient-to-br from-red-100 to-pink-100',
            status: 'مفتوح 24/7',
            statusClass: 'bg-green-100 text-green-700 border border-green-300',
            distance: '2.5 كم',
            eta: '8 دقائق',
            lat: 24.7236,
            lng: 46.6853,
            queueCount: 12,
            waitTime: '25 دقيقة',
            workingHours: '24 ساعة',
            isOpen: true
        },
        {
            id: 2,
            name: 'مركز الإسعاف الرئيسي',
            address: 'شارع العليا، حي العليا، وسط الرياض',
            phone: '997',
            icon: '🚑',
            bgClass: 'bg-gradient-to-br from-orange-100 to-red-100',
            status: 'متاح الآن',
            statusClass: 'bg-green-100 text-green-700 border border-green-300',
            distance: '1.8 كم',
            eta: '5 دقائق',
            lat: 24.7036,
            lng: 46.6653,
            queueCount: 3,
            waitTime: '10 دقائق',
            workingHours: '24 ساعة',
            isOpen: true
        },
        {
            id: 3,
            name: 'الدفاع المدني - المركز الرئيسي',
            address: 'طريق الملك عبدالعزيز، حي المربع',
            phone: '998',
            icon: '🚒',
            bgClass: 'bg-gradient-to-br from-red-100 to-yellow-100',
            status: 'جاهز للطوارئ',
            statusClass: 'bg-blue-100 text-blue-700 border border-blue-300',
            distance: '3.2 كم',
            eta: '12 دقيقة',
            lat: 24.7336,
            lng: 46.6953,
            queueCount: 5,
            waitTime: '15 دقيقة',
            workingHours: '24 ساعة',
            isOpen: true
        },
        {
            id: 4,
            name: 'مركز شرطة النخيل',
            address: 'حي النخيل، شمال الرياض',
            phone: '989',
            icon: '👮',
            bgClass: 'bg-gradient-to-br from-blue-100 to-indigo-100',
            status: 'خدمة 24 ساعة',
            statusClass: 'bg-green-100 text-green-700 border border-green-300',
            distance: '4.1 كم',
            eta: '15 دقيقة',
            lat: 24.7436,
            lng: 46.7053,
            queueCount: 8,
            waitTime: '20 دقيقة',
            workingHours: '24 ساعة',
            isOpen: true
        }
    ],
    municipalProjects: [
        {
            id: 1,
            name: 'مشروع تطوير طريق الملك فهد',
            location: 'من تقاطع العليا إلى حي الياسمين',
            icon: '🛣️',
            status: 'قيد التنفيذ',
            statusBadge: 'bg-blue-100 text-blue-700',
            contractor: 'شركة بن لادن السعودية',
            completion: 65,
            remaining: '4 أشهر',
            lat: 24.7200,
            lng: 46.6800
        },
        {
            id: 2,
            name: 'إنشاء حديقة الورود',
            location: 'حي الورود، شمال الرياض',
            icon: '🌳',
            status: 'المرحلة النهائية',
            statusBadge: 'bg-green-100 text-green-700',
            contractor: 'شركة العمران',
            completion: 85,
            remaining: '2 شهر',
            lat: 24.7400,
            lng: 46.7000
        },
        {
            id: 3,
            name: 'صيانة شبكة الإنارة',
            location: 'طريق الملك خالد',
            icon: '💡',
            status: 'جاري العمل',
            statusBadge: 'bg-yellow-100 text-yellow-700',
            contractor: 'الشركة السعودية للكهرباء',
            completion: 40,
            remaining: '6 أشهر',
            lat: 24.7100,
            lng: 46.6700
        }
    ],
    roadStatus: [
        { id: 1, name: 'طريق الملك فهد', icon: '🚗', status: 'ازدحام متوسط', statusClass: 'bg-yellow-100 text-yellow-700' },
        { id: 2, name: 'طريق الملك عبدالله', icon: '✅', status: 'سالك', statusClass: 'bg-green-100 text-green-700' },
        { id: 3, name: 'شارع العليا', icon: '🚧', status: 'صيانة', statusClass: 'bg-orange-100 text-orange-700' },
        { id: 4, name: 'طريق الملك خالد', icon: '🔴', status: 'ازدحام شديد', statusClass: 'bg-red-100 text-red-700' }
    ],
    heatmapTypes: [
        { id: 'accidents', name: 'الحوادث', icon: '⚠️', color: 'red' },
        { id: 'traffic', name: 'الازدحام', icon: '🚗', color: 'orange' },
        { id: 'maintenance', name: 'الصيانة', icon: '🚧', color: 'yellow' },
        { id: 'emergency', name: 'الطوارئ', icon: '🚨', color: 'red' },
        { id: 'schools', name: 'المدارس', icon: '🏫', color: 'blue' }
    ],
    heatmapData: {
        accidents: [[24.7136, 46.6753, 0.8], [24.7236, 46.6853, 0.9], [24.7036, 46.6653, 0.7]],
        traffic: [[24.7136, 46.6753, 0.9], [24.7150, 46.6770, 0.8], [24.7170, 46.6790, 0.7]],
        maintenance: [[24.7100, 46.6700, 0.9], [24.7120, 46.6720, 0.8], [24.7140, 46.6740, 0.7]],
        emergency: [[24.7236, 46.6853, 1.0], [24.7036, 46.6653, 0.9], [24.7336, 46.6953, 0.8]],
        schools: [[24.7200, 46.6800, 0.8], [24.7300, 46.6900, 0.7], [24.7400, 46.7000, 0.6]]
    },
    routeAlerts: [
        { id: 1, icon: '🚧', message: 'صيانة على طريق الملك فهد', class: 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' },
        { id: 2, icon: '🏫', message: 'مدرسة قريبة - قلل السرعة', class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800' }
    ],
    roadConditions: {
        'طريق الملك فهد': {
            status: 'ازدحام متوسط',
            speed: 45,
            incidents: 2,
            color: '#f59e0b',
            icon: '🚗',
            statusClass: 'bg-yellow-100 text-yellow-700',
            description: 'حركة متوسطة مع بعض التباطؤ'
        },
        'طريق الملك عبدالله': {
            status: 'سالك',
            speed: 80,
            incidents: 0,
            color: '#10b981',
            icon: '✅',
            statusClass: 'bg-green-100 text-green-700',
            description: 'الطريق سالك بدون ازدحام'
        },
        'شارع العليا': {
            status: 'صيانة',
            speed: 30,
            incidents: 1,
            color: '#f97316',
            icon: '🚧',
            statusClass: 'bg-orange-100 text-orange-700',
            description: 'يوجد أعمال صيانة على الطريق'
        },
        'طريق الملك خالد': {
            status: 'ازدحام شديد',
            speed: 15,
            incidents: 3,
            color: '#ef4444',
            icon: '🔴',
            statusClass: 'bg-red-100 text-red-700',
            description: 'ازدحام شديد - يفضل اختيار طريق بديل'
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
        return L.heatLayer(data, { radius: 25, blur: 15, maxZoom: 17, gradient }).addTo(map);
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
            accidents: { 0.4: 'yellow', 0.6: 'orange', 0.8: 'red' },
            traffic: { 0.4: 'green', 0.6: 'yellow', 0.8: 'red' },
            maintenance: { 0.4: 'blue', 0.6: 'yellow', 0.8: 'orange' },
            emergency: { 0.4: 'pink', 0.6: 'red', 0.8: 'darkred' },
            schools: { 0.4: 'lightblue', 0.6: 'blue', 0.8: 'darkblue' }
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

// ==================== Vue App ====================
const { createApp } = Vue;

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
            isLoading: false,
            loadingMessage: 'جاري تحميل البيانات...',
            realtimeEnabled: false,
            notificationsEnabled: true,
            lastUpdate: null
        };
    },
    
    mounted() {
        this.initMap();
        this.loadAllMarkers();
        document.addEventListener('click', this.handleClickOutside);
    },
    
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
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
        
        performSearch() {
            this.searchResults = window.ServiceFunctions.searchServices(this.searchQuery, this.emergencyServices, this.municipalProjects);
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
        
        toggleStatistics() {
            // دالة لتبديل عرض الإحصائيات
            const statsPanel = document.querySelector('.statistics-panel');
            if (statsPanel) {
                const isVisible = statsPanel.style.display === 'block';
                statsPanel.style.display = isVisible ? 'none' : 'block';
                if (!isVisible) {
                    this.showSearchResults = false;
                    this.selectedServiceDetails = null;
                }
            }
        },
        
        toggleRealtimeUpdates() {
            this.realtimeEnabled = !this.realtimeEnabled;
            if (this.realtimeEnabled) {
                this.startRealtimeUpdates();
            } else {
                this.stopRealtimeUpdates();
            }
        },
        
        startRealtimeUpdates() {
            // دالة لبدء التحديثات اللحظية
            this.lastUpdate = Date.now();
            this.realtimeInterval = setInterval(() => {
                this.lastUpdate = Date.now();
                // هنا يمكن إضافة كود لجلب البيانات الجديدة إذا لزم الأمر
            }, 60000); // تحديث كل 60 ثانية
        },
        
        stopRealtimeUpdates() {
            // دالة لإيقاف التحديثات اللحظية
            clearInterval(this.realtimeInterval);
            this.realtimeInterval = null;
        },
        
        refreshAllData() {
            // دالة لتحديث جميع البيانات
            window.UIFunctions.showNotification(this.notifications, {
                title: 'تحديث البيانات',
                message: 'جاري تحديث البيانات...',
                icon: '🔄',
                class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-900'
            });
            
            // هنا يمكن إضافة كود لجلب البيانات الجديدة وتحديث الخريطة
            
            setTimeout(() => {
                window.UIFunctions.showNotification(this.notifications, {
                    title: 'تم تحديث البيانات',
                    message: 'تم تحديث البيانات بنجاح',
                    icon: '✅',
                    class: 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-900'
                });
            }, 2000);
        }
    }
}).mount('#mapApp');
</script>

<div id="mapApp" class="relative" style="font-family: 'Cairo', sans-serif;">
    
    <!-- Loading Overlay -->
    <div v-if="isLoading" class="fixed inset-0 z-[99999] flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="text-center">
            <!-- Animated Spinner -->
            <div class="relative mb-8">
                <div class="inline-block animate-spin rounded-full h-24 w-24 border-4 border-blue-500 border-t-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-4xl animate-pulse">🗺️</span>
                </div>
            </div>
            
            <!-- Loading Text -->
            <h2 class="text-3xl font-bold text-gray-800 mb-2 animate-pulse">@{{ loadingMessage }}</h2>
            <p class="text-sm text-gray-600 mb-6">يرجى الانتظار قليلاً...</p>
            
            <!-- Progress Bar -->
            <div class="w-80 max-w-full h-2 bg-gray-200 rounded-full overflow-hidden mx-auto">
                <div class="h-full bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 rounded-full animate-pulse" style="width: 70%; transition: width 0.5s ease;"></div>
            </div>
            
            <!-- Loading Details -->
            <div class="mt-6 space-y-2">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-600">
                    <span class="animate-bounce">📍</span>
                    <span>تحميل الخدمات الطارئة</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-sm text-gray-600">
                    <span class="animate-bounce" style="animation-delay: 0.2s;">🏗️</span>
                    <span>تحميل المشاريع البلدية</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-sm text-gray-600">
                    <span class="animate-bounce" style="animation-delay: 0.4s;">🚗</span>
                    <span>تحميل حالة الطرق</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map Container -->
    <div id="map" class="w-full h-screen"></div>
    
    <!-- Statistics Button (في الزاوية اليسرى العلوية) -->
    <button 
        @click="toggleStatistics" 
        class="fixed top-20 left-4 z-[9998] glass-effect p-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-2 border-white/30"
        title="عرض الإحصائيات">
        <span class="text-2xl">📊</span>
    </button>
    
    <!-- Statistics Dashboard -->
    @include('map.components.statistics')
    
    <!-- Real-time Updates Control Panel -->
    <div class="fixed bottom-4 left-4 z-[9998] flex flex-col gap-2">
        <!-- Real-time Toggle -->
        <button 
            @click="toggleRealtimeUpdates" 
            :class="realtimeEnabled ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 hover:bg-gray-600'"
            class="glass-effect p-3 rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-1 border-2 border-white/30 text-white"
            :title="realtimeEnabled ? 'إيقاف التحديثات اللحظية' : 'تفعيل التحديثات اللحظية'">
            <span class="text-xl">@{{ realtimeEnabled ? '📡' : '⏸️' }}</span>
        </button>
        
        <!-- Refresh Button -->
        <button 
            @click="refreshAllData" 
            class="glass-effect p-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:rotate-180 border-2 border-white/30 bg-blue-500 hover:bg-blue-600 text-white"
            title="تحديث البيانات">
            <span class="text-xl">🔄</span>
        </button>
        
        <!-- Notifications Toggle -->
        <button 
            @click="notificationsEnabled = !notificationsEnabled" 
            :class="notificationsEnabled ? 'bg-purple-500 hover:bg-purple-600' : 'bg-gray-500 hover:bg-gray-600'"
            class="glass-effect p-3 rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-1 border-2 border-white/30 text-white"
            :title="notificationsEnabled ? 'تعطيل الإشعارات' : 'تفعيل الإشعارات'">
            <span class="text-xl">@{{ notificationsEnabled ? '🔔' : '🔕' }}</span>
        </button>
    </div>
    
    <!-- Last Update Indicator -->
    <div v-if="lastUpdate" class="fixed bottom-4 right-4 z-[9998] glass-effect px-4 py-2 rounded-xl shadow-lg border-2 border-white/30 text-xs text-gray-600">
        آخر تحديث: @{{ new Date(lastUpdate).toLocaleTimeString('ar-SA') }}
    </div>
    
    <!-- ...existing code... -->
    
</div>
@endsection

@section('scripts')
    @include('map.scripts')
@endsection