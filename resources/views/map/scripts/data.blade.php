<script>
// البيانات الثابتة - Data Store
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
        accidents: [
            [24.7136, 46.6753, 0.8], [24.7236, 46.6853, 0.9], [24.7036, 46.6653, 0.7],
            [24.7336, 46.6953, 0.6], [24.7436, 46.7053, 0.5], [24.7100, 46.6700, 0.8]
        ],
        traffic: [
            [24.7136, 46.6753, 0.9], [24.7150, 46.6770, 0.8], [24.7170, 46.6790, 0.7],
            [24.7190, 46.6810, 0.9], [24.7210, 46.6830, 0.8]
        ],
        maintenance: [
            [24.7100, 46.6700, 0.9], [24.7120, 46.6720, 0.8], [24.7140, 46.6740, 0.7]
        ],
        emergency: [
            [24.7236, 46.6853, 1.0], [24.7036, 46.6653, 0.9], [24.7336, 46.6953, 0.8]
        ],
        schools: [
            [24.7200, 46.6800, 0.8], [24.7300, 46.6900, 0.7], [24.7400, 46.7000, 0.6]
        ]
    },

    routeAlerts: [
        { id: 1, icon: '🚧', message: 'صيانة على طريق الملك فهد', class: 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' },
        { id: 2, icon: '🏫', message: 'مدرسة قريبة - قلل السرعة', class: 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800' }
    ],

    mapProviders: {
        osm: {
            name: 'OpenStreetMap',
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution: '© OpenStreetMap',
            options: { maxZoom: 19, tileSize: 256, zoomOffset: 0 }
        },
        maptilerLight: {
            name: 'MapTiler Light',
            url: 'https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler © OpenStreetMap',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerDark: {
            name: 'MapTiler Dark',
            url: 'https://api.maptiler.com/maps/streets-v2-dark/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler © OpenStreetMap',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerArabic: {
            name: 'MapTiler عربي',
            url: 'https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler © OpenStreetMap',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerSatellite: {
            name: 'MapTiler Satellite',
            url: 'https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key={key}',
            attribution: '© MapTiler © OpenStreetMap',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },

        // إضافة أنماط MapTiler المخصصة الجميلة
        maptilerBasic: {
            name: 'أساسي نظيف',
            url: 'https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerVoyager: {
            name: 'Voyager - كلاسيكي',
            url: 'https://api.maptiler.com/maps/voyager/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerTopo: {
            name: 'طبوغرافي',
            url: 'https://api.maptiler.com/maps/topo/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerWinter: {
            name: 'شتوي',
            url: 'https://api.maptiler.com/maps/winter/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerOutdoor: {
            name: 'خارجي',
            url: 'https://api.maptiler.com/maps/outdoor/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        },
        maptilerPastel: {
            name: 'باستيل',
            url: 'https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key={key}',
            attribution: '© MapTiler',
            key: 'FTEwYIdJtQUe56EPWul2',
            options: { maxZoom: 22, tileSize: 512, zoomOffset: -1 }
        }
    },

    // POI Categories for Overpass API
    poiCategories: {
        restaurants: { icon: '🍽️', color: '#ef4444', query: 'node["amenity"="restaurant"]' },
        hospitals: { icon: '🏥', color: '#10b981', query: 'node["amenity"="hospital"]' },
        schools: { icon: '🏫', color: '#3b82f6', query: 'node["amenity"="school"]' },
        shops: { icon: '🛒', color: '#f59e0b', query: 'node["shop"]' },
        mosques: { icon: '🕌', color: '#8b5cf6', query: 'node["amenity"="place_of_worship"]["religion"="muslim"]' }
    },

    // Traffic Data (بيانات الازدحام المروري)
    trafficData: [
        {
            name: 'طريق الملك فهد',
            coordinates: [
                [24.7136, 46.6753],
                [24.7200, 46.6800],
                [24.7236, 46.6853]
            ],
            congestion: 'medium',
            status: 'ازدحام متوسط',
            speed: 45
        },
        {
            name: 'طريق الملك عبدالله',
            coordinates: [
                [24.7036, 46.6653],
                [24.7100, 46.6700],
                [24.7150, 46.6750]
            ],
            congestion: 'low',
            status: 'سالك',
            speed: 80
        },
        {
            name: 'شارع العليا',
            coordinates: [
                [24.7336, 46.6953],
                [24.7400, 46.7000],
                [24.7436, 46.7053]
            ],
            congestion: 'high',
            status: 'ازدحام شديد',
            speed: 20
        }
    ],

    // Service Zones (مناطق الخدمة)
    serviceZones: [
        {
            name: 'منطقة الخدمة الطبية',
            center: { lat: 24.7236, lng: 46.6853 },
            radius: 2000,
            color: '#ef4444'
        },
        {
            name: 'منطقة الطوارئ',
            center: { lat: 24.7036, lng: 46.6653 },
            radius: 1500,
            color: '#f59e0b'
        },
        {
            name: 'منطقة الأمن',
            center: { lat: 24.7436, lng: 46.7053 },
            radius: 2500,
            color: '#3b82f6'
        }
    ],

    // Weather Data (بيانات الطقس)
    weatherData: {
        temperature: 28,
        humidity: 45,
        windSpeed: 15,
        condition: 'صافي',
        icon: '☀️'
    }
};
</script>
