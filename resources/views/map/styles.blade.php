<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap');
    
    * {
        font-family: 'Cairo', sans-serif;
    }
    
    /* Fix Map z-index issue */
    #map {
        z-index: 1 !important;
        filter: brightness(1.05) contrast(1.1);
    }
    
    .leaflet-pane,
    .leaflet-top,
    .leaflet-bottom {
        z-index: 10 !important;
    }
    
    .leaflet-control-zoom {
        z-index: 15 !important;
    }
    
    /* Mobile-First Glass Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    
    @media (min-width: 768px) {
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
    }
    
    .dark .glass-effect {
        background: rgba(17, 24, 39, 0.95);
    }
    
    /* Map Marker Animations */
    .map-marker {
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: markerBounce 2s ease-in-out infinite;
    }
    
    .map-marker:hover {
        transform: scale(1.3) rotate(5deg);
        animation: none;
    }
    
    @keyframes markerBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    /* Transitions */
    .fade-enter-active, .fade-leave-active {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .fade-enter-from {
        opacity: 0;
        transform: translateY(-10px);
    }
    
    .fade-leave-to {
        opacity: 0;
        transform: translateY(10px);
    }
    
    .slide-up-enter-active, .slide-up-leave-active {
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .slide-up-enter-from {
        opacity: 0;
        transform: translateY(100px);
    }
    
    .slide-up-leave-to {
        opacity: 0;
        transform: translateY(-100px);
    }
    
    /* Mobile Notification Styles */
    .notification {
        animation: slideInRight 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        max-width: calc(100vw - 2rem);
    }
    
    @media (min-width: 768px) {
        .notification {
            max-width: 400px;
        }
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .notification.removing {
        animation: slideOutRight 0.3s ease-in-out forwards;
    }
    
    @keyframes slideOutRight {
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    /* Mobile-Optimized Heatmap Controls */
    .heatmap-control {
        position: fixed;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000 !important;
        max-width: calc(100vw - 1rem);
        width: 100%;
        padding: 0 0.5rem;
    }
    
    @media (min-width: 768px) {
        .heatmap-control {
            bottom: 20px;
            max-width: 90vw;
            padding: 0;
        }
    }
    
    .heatmap-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
    }
    
    .heatmap-btn:active {
        transform: scale(0.95);
    }
    
    @media (min-width: 768px) {
        .heatmap-btn:hover {
            transform: translateY(-3px);
        }
    }
    
    .heatmap-btn.active {
        animation: heatmapPulse 2s infinite;
    }
    
    @keyframes heatmapPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
        }
        50% {
            box-shadow: 0 0 0 8px rgba(59, 130, 246, 0);
        }
    }
    
    /* Mobile Service Card */
    .service-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
    }
    
    .service-card:active {
        transform: scale(0.98);
    }
    
    @media (min-width: 768px) {
        .service-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }
    }
    
    /* Custom Scrollbar - Hidden on Mobile */
    @media (min-width: 768px) {
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }
    }
    
    /* Mobile Service Details Modal */
    .service-details-modal {
        animation: modalSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(100px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Emergency Services Panel - Fixed for Desktop */
    @media (min-width: 768px) {
        .emergency-panel-desktop {
            position: absolute !important;
            top: 1rem !important;
            left: 1rem !important;
            right: auto !important;
            width: 420px !important;
            max-height: calc(100vh - 8rem) !important;
            z-index: 1100 !important;
        }
    }
    
    /* Mobile Emergency Panel */
    @media (max-width: 767px) {
        .emergency-panel-mobile {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 1100 !important;
        }
    }
    
    /* Road Status Panel - Always Visible */
    .road-status-mobile {
        z-index: 900 !important;
    }
    
    @media (max-width: 767px) {
        .road-status-mobile {
            top: 70px !important;
            right: 0.5rem !important;
            max-width: calc(100vw - 1rem) !important;
        }
    }
    
    /* Projects Panel */
    .projects-panel-mobile {
        z-index: 1100 !important;
    }
    
    @media (max-width: 767px) {
        .projects-panel-mobile {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            max-width: 100% !important;
            border-radius: 0 !important;
        }
    }
    
    /* Mobile Road Status - Compact */
    @media (max-width: 767px) {
        .road-status-mobile {
            top: 70px !important;
            right: 0.5rem !important;
            left: 0.5rem !important;
            max-width: calc(100vw - 1rem) !important;
        }
    }
    
    /* Mobile Projects Panel */
    @media (max-width: 767px) {
        .projects-panel-mobile {
            position: fixed !important;
            top: 60px !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            max-height: calc(100vh - 60px) !important;
            border-radius: 0 !important;
            margin: 0 !important;
        }
    }
    
    /* Mobile Notifications Position */
    @media (max-width: 767px) {
        .notifications-container {
            top: 60px !important;
            left: 0.5rem !important;
            right: 0.5rem !important;
            width: auto !important;
        }
    }
    
    /* Hide Leaflet Routing Control Default UI */
    .leaflet-routing-container {
        display: none !important;
    }
    
    /* Mobile Search Results */
    @media (max-width: 767px) {
        .search-results-mobile {
            position: fixed !important;
            top: 60px !important;
            left: 0 !important;
            right: 0 !important;
            max-height: 50vh !important;
            border-radius: 0 !important;
            margin: 0 !important;
        }
    }
    
    /* Prevent text selection on mobile */
    @media (max-width: 767px) {
        button, .service-card, .heatmap-btn {
            -webkit-user-select: none;
            user-select: none;
        }
    }
    
    /* Mobile Header Fixed */
    .mobile-header {
        position: sticky;
        top: 0;
        z-index: 40;
    }
    
    /* Better touch targets for mobile */
    @media (max-width: 767px) {
        button, a {
            min-height: 44px;
            min-width: 44px;
        }
    }
    
    /* Mobile Safe Area Support */
    @supports (padding: max(0px)) {
        .mobile-safe-area-top {
            padding-top: max(0.5rem, env(safe-area-inset-top));
        }
        
        .mobile-safe-area-bottom {
            padding-bottom: max(0.5rem, env(safe-area-inset-bottom));
        }
    }
    
    /* ==================== Professional Leaflet Enhancements ==================== */
    
    /* Map Tiles Smooth Transitions */
    .map-tiles {
        transition: opacity 0.3s ease-in-out;
    }
    
    /* Custom Zoom Control */
    .leaflet-control-zoom {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
        border-radius: 12px !important;
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95) !important;
    }
    
    .leaflet-control-zoom a {
        width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        font-size: 20px !important;
        border: none !important;
        background: transparent !important;
        color: #1f2937 !important;
        transition: all 0.2s ease !important;
    }
    
    .leaflet-control-zoom a:hover {
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        color: white !important;
        transform: scale(1.1);
    }
    
    /* ==================== User Location Marker (Animated Pulse) ==================== */
    .user-location-marker {
        position: relative;
        width: 50px;
        height: 50px;
    }
    
    .pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 3px solid #3b82f6;
        border-radius: 50%;
        animation: pulse 2s infinite;
        opacity: 0;
    }
    
    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(0.5);
            opacity: 1;
        }
        100% {
            transform: translate(-50%, -50%) scale(1.5);
            opacity: 0;
        }
    }
    
    .user-dot {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 16px;
        height: 16px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: 3px solid white;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(59, 130, 246, 0.5);
        animation: userDotPulse 1.5s ease-in-out infinite;
    }
    
    @keyframes userDotPulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.15); }
    }
    
    /* ==================== Service Markers مع Shadow ==================== */
    .marker-container {
        position: relative;
        width: 40px;
        height: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .marker-shadow {
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 8px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        filter: blur(4px);
        transition: all 0.3s ease;
    }
    
    .marker-pin {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%) rotate(-45deg);
        width: 36px;
        height: 36px;
        border-radius: 50% 50% 50% 0;
        transform-origin: bottom center;
        transform: translateX(-50%) rotate(-45deg);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        border: 3px solid white;
    }
    
    .marker-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
        font-size: 18px;
        filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.2));
    }
    
    .marker-pulse {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: inherit;
        animation: markerPulse 2s ease-out infinite;
        opacity: 0;
    }
    
    @keyframes markerPulse {
        0% {
            transform: translateX(-50%) scale(1);
            opacity: 0.7;
        }
        100% {
            transform: translateX(-50%) scale(1.8);
            opacity: 0;
        }
    }
    
    /* Marker Hover Effect */
    .marker-hover .marker-pin {
        transform: translateX(-50%) rotate(-45deg) translateY(-8px) scale(1.15);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    
    .marker-hover .marker-shadow {
        width: 35px;
        opacity: 0.5;
    }
    
    /* ==================== Project Markers ==================== */
    .project-marker-container {
        position: relative;
    }
    
    .project-pin {
        position: relative;
        width: 35px;
        height: 40px;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        border: 3px solid white;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .project-pin:hover {
        transform: rotate(-45deg) scale(1.1);
    }
    
    .project-pin span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
        font-size: 16px;
        z-index: 2;
    }
    
    .project-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.4);
        transition: height 0.5s ease;
    }
    
    /* ==================== Premium Popups ==================== */
    .premium-popup {
        font-family: 'Cairo', sans-serif;
        min-width: 280px;
    }
    
    .popup-header {
        padding: 15px;
        color: white;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .popup-icon {
        font-size: 28px;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    .popup-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.3;
    }
    
    .popup-body {
        padding: 15px;
        background: white;
    }
    
    .popup-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 10px;
        padding: 8px;
        background: #f9fafb;
        border-radius: 8px;
        transition: background 0.2s ease;
    }
    
    .popup-item:hover {
        background: #f3f4f6;
    }
    
    .popup-label {
        font-size: 18px;
        flex-shrink: 0;
    }
    
    .popup-text {
        font-size: 13px;
        color: #374151;
        line-height: 1.4;
    }
    
    .popup-button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 0 0 12px 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Cairo', sans-serif;
    }
    
    .popup-button:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
    
    .popup-button:active {
        transform: translateY(0);
    }
    
    /* Progress Bar في Popup */
    .progress-bar-container {
        margin-top: 10px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
    }
    
    .progress-value {
        color: #1f2937;
        font-weight: 700;
    }
    
    .progress-bar {
        width: 100%;
        height: 8px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        border-radius: 999px;
        transition: width 0.5s ease;
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
    }
    
    /* Custom Leaflet Popup Styling */
    .custom-leaflet-popup .leaflet-popup-content-wrapper {
        padding: 0 !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
        overflow: hidden;
    }
    
    .custom-leaflet-popup .leaflet-popup-content {
        margin: 0 !important;
        width: auto !important;
    }
    
    .custom-leaflet-popup .leaflet-popup-tip {
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* ==================== Marker Clustering ==================== */
    .cluster-marker {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-radius: 50%;
        text-align: center;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .cluster-marker:hover {
        transform: scale(1.15);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    }
    
    .cluster-small {
        width: 35px !important;
        height: 35px !important;
        font-size: 13px;
    }
    
    .cluster-medium {
        width: 45px !important;
        height: 45px !important;
        font-size: 15px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }
    
    .cluster-large {
        width: 55px !important;
        height: 55px !important;
        font-size: 17px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }
    
    /* ==================== Dark Theme Support ==================== */
    .dark-theme .leaflet-control-zoom {
        background: rgba(31, 41, 55, 0.95) !important;
    }
    
    .dark-theme .leaflet-control-zoom a {
        color: #f9fafb !important;
    }
    
    .dark-theme .leaflet-control-zoom a:hover {
        background: linear-gradient(135deg, #4f46e5, #4338ca) !important;
    }
    
    .dark-theme .premium-popup .popup-body {
        background: #1f2937;
    }
    
    .dark-theme .popup-item {
        background: #111827;
    }
    
    .dark-theme .popup-item:hover {
        background: #0f172a;
    }
    
    .dark-theme .popup-text {
        color: #e5e7eb;
    }
    
    /* ==================== Responsive ==================== */
    @media (max-width: 768px) {
        .premium-popup {
            min-width: 260px;
        }
        
        .popup-header h3 {
            font-size: 14px;
        }
        
        .popup-icon {
            font-size: 24px;
        }
        
        .marker-pin {
            width: 32px;
            height: 32px;
        }
        
        .marker-icon {
            font-size: 16px;
        }
    }
    
    /* ==================== Traffic Lines ==================== */
    .traffic-line {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .traffic-line:hover {
        filter: brightness(1.2);
        stroke-width: 8 !important;
    }
    
    .traffic-tooltip {
        background: rgba(255, 255, 255, 0.95) !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15) !important;
        padding: 10px !important;
        font-family: 'Cairo', sans-serif !important;
    }
    
    /* ==================== Moving Car Animation ==================== */
    .car-container {
        position: relative;
        width: 40px;
        height: 40px;
        transition: transform 0.3s ease;
    }
    
    .car-shadow {
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 8px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        filter: blur(3px);
        animation: carShadowPulse 1s ease-in-out infinite;
    }
    
    @keyframes carShadowPulse {
        0%, 100% { opacity: 0.5; transform: translateX(-50%) scale(1); }
        50% { opacity: 0.8; transform: translateX(-50%) scale(1.1); }
    }
    
    .car-body {
        font-size: 30px;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        animation: carBounce 0.5s ease-in-out infinite;
    }
    
    @keyframes carBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    
    /* ==================== Service Zones ==================== */
    .service-zone {
        animation: zoneExpand 3s ease-in-out infinite;
    }
    
    @keyframes zoneExpand {
        0%, 100% { 
            stroke-opacity: 0.8;
            fill-opacity: 0.15;
        }
        50% { 
            stroke-opacity: 1;
            fill-opacity: 0.25;
        }
    }
    
    .zone-label-text {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 3px 10px rgba(139, 92, 246, 0.4);
        text-align: center;
        font-family: 'Cairo', sans-serif;
    }
    
    /* ==================== Measure Tool ==================== */
    .measure-dot {
        width: 10px;
        height: 10px;
        background: #3b82f6;
        border: 2px solid white;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.5);
        animation: measurePulse 1s ease-in-out infinite;
    }
    
    @keyframes measurePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.3); }
    }
    
    .distance-text {
        background: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        color: #1f2937;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        white-space: nowrap;
        font-family: 'Cairo', sans-serif;
        border: 2px solid #3b82f6;
    }
    
    /* ==================== POI Markers ==================== */
    .poi-container {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .poi-container:hover {
        transform: scale(1.2);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    .poi-icon {
        font-size: 16px;
    }
    
    .poi-popup .popup-header {
        padding: 12px;
    }
    
    .poi-popup .popup-header h3 {
        font-size: 14px;
        margin: 0;
    }
    
    /* ==================== Isochrone Circles ==================== */
    .leaflet-interactive[stroke-dasharray] {
        animation: dashAnimation 20s linear infinite;
    }
    
    @keyframes dashAnimation {
        to {
            stroke-dashoffset: -100;
        }
    }
    
    /* ==================== Weather Layer Overlay ==================== */
    .weather-info-box {
        position: absolute;
        top: 80px;
        right: 10px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        font-family: 'Cairo', sans-serif;
        min-width: 200px;
    }
    
    .weather-info-box h4 {
        margin: 0 0 10px 0;
        font-size: 14px;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .weather-item {
        display: flex;
        justify-content: space-between;
        margin: 8px 0;
        font-size: 12px;
        color: #6b7280;
    }
    
    .weather-value {
        font-weight: 700;
        color: #1f2937;
    }
    
    /* ==================== Floating Control Buttons ==================== */
    .map-control-button {
        position: absolute;
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
        border: none;
        font-size: 20px;
    }
    
    .map-control-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
    
    .map-control-button:active {
        transform: translateY(0);
    }
    
    .map-control-button.active {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }
    
    /* Positioning */
    .control-3d {
        bottom: 160px;
        left: 10px;
    }
    
    .control-traffic {
        bottom: 110px;
        left: 10px;
    }
    
    .control-measure {
        bottom: 60px;
        left: 10px;
    }
    
    .control-poi {
        bottom: 10px;
        left: 60px;
    }
    
    /* ==================== Responsive Mobile ==================== */
    @media (max-width: 768px) {
        .weather-info-box {
            top: 70px;
            right: 5px;
            padding: 10px;
            min-width: 160px;
        }
        
        .weather-info-box h4 {
            font-size: 12px;
        }
        
        .weather-item {
            font-size: 11px;
        }
        
        .map-control-button {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        
        .control-3d { bottom: 140px; left: 5px; }
        .control-traffic { bottom: 90px; left: 5px; }
        .control-measure { bottom: 40px; left: 5px; }
        .control-poi { bottom: 5px; left: 50px; }
    }
    
    /* ==================== Map Visual Effects ==================== */
    
    /* Vignette Effect - تظليل الأطراف */
    .map-vignette {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 450;
        background: radial-gradient(
            circle at center,
            transparent 40%,
            rgba(0, 0, 0, 0.1) 70%,
            rgba(0, 0, 0, 0.2) 100%
        );
    }
    
    /* Map Filter Transitions */
    #map {
        transition: filter 0.5s ease;
    }
    
    .map-vintage {
        animation: vintageFlicker 3s ease-in-out infinite;
    }
    
    @keyframes vintageFlicker {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.98; }
    }
    
    .map-neon {
        animation: neonGlow 2s ease-in-out infinite;
    }
    
    @keyframes neonGlow {
        0%, 100% { filter: saturate(1.5) contrast(1.2) brightness(1.1); }
        50% { filter: saturate(1.6) contrast(1.25) brightness(1.15) drop-shadow(0 0 20px #3b82f6); }
    }
    
    /* Grid Overlay */
    .map-grid-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 450;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }
    
    .map-grid-overlay:hover {
        opacity: 0.8;
    }
    
    /* Particle Canvas */
    .particle-canvas {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 450;
        opacity: 0.4;
        mix-blend-mode: screen;
    }
    
    /* ==================== Compass Rose ==================== */
    .compass-rose {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 50%;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15), inset 0 0 0 2px rgba(59, 130, 246, 0.3);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 3px solid white;
    }
    
    .compass-rose:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), inset 0 0 0 3px rgba(59, 130, 246, 0.5);
    }
    
    .compass-needle {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 50px solid #ef4444;
        transform-origin: bottom center;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        filter: drop-shadow(0 2px 4px rgba(239, 68, 68, 0.5));
        z-index: 2;
    }
    
    .compass-needle::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 50px solid #e5e7eb;
    }
    
    .compass-directions {
        position: absolute;
        width: 100%;
        height: 100%;
        font-family: 'Cairo', sans-serif;
    }
    
    .compass-directions span {
        position: absolute;
        font-size: 10px;
        font-weight: 700;
        color: #1f2937;
        text-align: center;
        line-height: 1.2;
    }
    
    .compass-n {
        top: 5px;
        left: 50%;
        transform: translateX(-50%);
        color: #ef4444;
    }
    
    .compass-e {
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
    }
    
    .compass-s {
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .compass-w {
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
    }
    
    /* ==================== Accuracy Circle Animation ==================== */
    .accuracy-circle {
        animation: accuracyPulse 2s ease-in-out infinite;
    }
    
    @keyframes accuracyPulse {
        0%, 100% { 
            stroke-opacity: 0.8;
            fill-opacity: 0.1;
        }
        50% { 
            stroke-opacity: 1;
            fill-opacity: 0.2;
        }
    }
    
    /* ==================== Animated Bounds ==================== */
    .animated-bounds {
        animation: boundsGlow 3s ease-in-out infinite;
    }
    
    @keyframes boundsGlow {
        0%, 100% { 
            stroke-opacity: 0.6;
            stroke-width: 3px;
        }
        50% { 
            stroke-opacity: 1;
            stroke-width: 5px;
            filter: drop-shadow(0 0 10px currentColor);
        }
    }
    
    /* ==================== Glow Polyline ==================== */
    .glow-line {
        animation: lineGlow 2s ease-in-out infinite;
    }
    
    @keyframes lineGlow {
        0%, 100% { 
            stroke-opacity: 0.3;
            filter: blur(3px);
        }
        50% { 
            stroke-opacity: 0.5;
            filter: blur(5px) brightness(1.2);
        }
    }
    
    /* ==================== Corner Decorations ==================== */
    .map-corner-decoration {
        position: absolute;
        width: 60px;
        height: 60px;
        pointer-events: none;
        z-index: 500;
        opacity: 0.3;
    }
    
    .corner-tl {
        top: 0;
        left: 0;
        border-top: 3px solid #3b82f6;
        border-left: 3px solid #3b82f6;
        border-radius: 0 0 12px 0;
    }
    
    .corner-tr {
        top: 0;
        right: 0;
        border-top: 3px solid #3b82f6;
        border-right: 3px solid #3b82f6;
        border-radius: 0 0 0 12px;
    }
    
    .corner-bl {
        bottom: 0;
        left: 0;
        border-bottom: 3px solid #3b82f6;
        border-left: 3px solid #3b82f6;
        border-radius: 0 12px 0 0;
    }
    
    .corner-br {
        bottom: 0;
        right: 0;
        border-bottom: 3px solid #3b82f6;
        border-right: 3px solid #3b82f6;
        border-radius: 12px 0 0 0;
    }
    
    /* ==================== Map Loading Animation ==================== */
    .map-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 20px;
        animation: fadeOut 1s ease-out 2s forwards;
    }
    
    @keyframes fadeOut {
        to {
            opacity: 0;
            pointer-events: none;
        }
    }
    
    .map-loader {
        width: 80px;
        height: 80px;
        border: 5px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .map-loading-text {
        color: white;
        font-family: 'Cairo', sans-serif;
        font-size: 18px;
        font-weight: 700;
        animation: pulse 1.5s ease-in-out infinite;
    }
    
    /* ==================== Tile Loading Shimmer ==================== */
    .leaflet-tile-container {
        animation: tileShimmer 1.5s ease-in-out;
    }
    
    @keyframes tileShimmer {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* ==================== Custom Scale Bar ==================== */
    .leaflet-control-scale {
        font-family: 'Cairo', sans-serif !important;
        font-weight: 600 !important;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(249, 250, 251, 0.95)) !important;
        backdrop-filter: blur(10px) !important;
        border-radius: 10px !important;
        padding: 10px 15px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
        border: 2px solid rgba(59, 130, 246, 0.3) !important;
        transition: all 0.3s ease !important;
    }
    
    .leaflet-control-scale:hover {
        border-color: rgba(59, 130, 246, 0.6) !important;
        box-shadow: 0 6px 25px rgba(59, 130, 246, 0.2) !important;
        transform: translateY(-2px);
    }
    
    /* ==================== Crosshair Center Indicator ==================== */
    .map-crosshair {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        pointer-events: none;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .map-crosshair.active {
        opacity: 0.5;
    }
    
    .map-crosshair::before,
    .map-crosshair::after {
        content: '';
        position: absolute;
        background: #3b82f6;
    }
    
    .map-crosshair::before {
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        transform: translateY(-50%);
    }
    
    .map-crosshair::after {
        left: 50%;
        top: 0;
        height: 100%;
        width: 2px;
        transform: translateX(-50%);
    }
    
    /* ==================== Responsive ==================== */
    @media (max-width: 768px) {
        .compass-rose {
            width: 80px;
            height: 80px;
            top: 10px;
            left: 10px;
        }
        
        .compass-needle {
            border-left-width: 6px;
            border-right-width: 6px;
            border-bottom-width: 35px;
        }
        
        .compass-directions span {
            font-size: 8px;
        }
        
        .map-corner-decoration {
            width: 40px;
            height: 40px;
        }
        
        .map-vignette {
            opacity: 0.5;
        }
    }
    
    /* Dark Theme Adjustments */
    .dark-theme .compass-rose {
        background: rgba(31, 41, 55, 0.95);
    }
    
    .dark-theme .compass-directions span {
        color: #f9fafb;
    }
    
    .dark-theme .map-vignette {
        background: radial-gradient(
            circle at center,
            transparent 40%,
            rgba(0, 0, 0, 0.3) 70%,
            rgba(0, 0, 0, 0.5) 100%
        );
    }
    
    /* ==================== Service Details Panel - Compact ==================== */
    .service-details-panel {
        z-index: 1050 !important;
    }
    
    @media (min-width: 768px) {
        .service-details-panel {
            top: 5rem !important;
            max-height: calc(100vh - 6rem) !important;
        }
    }
    
    @media (max-width: 767px) {
        .service-details-panel {
            position: fixed !important;
            top: 60px !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            border-radius: 0 !important;
        }
    }
    
    /* ==================== Route Condition Popup - Highest Priority ==================== */
    
    /* Backdrop - أقل من الـ popup */
    .popup-backdrop {
        position: fixed !important;
        inset: 0 !important;
        background: rgba(0, 0, 0, 0.85) !important;
        z-index: 9998 !important;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .popup-backdrop.active {
        opacity: 1;
    }
    
    /* Desktop: إخفاء backdrop */
    @media (min-width: 768px) {
        .popup-backdrop {
            display: none !important;
        }
    }
    
    /* Popup Container - Mobile First */
    .route-popup-overlay-container {
        position: fixed !important;
        inset: 0 !important;
        z-index: 99999 !important;
        overflow-y: auto !important;
        background: white !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border: none !important;
        opacity: 0;
        transform: translateY(100%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .route-popup-overlay-container.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Desktop: تحويل لـ absolute */
    @media (min-width: 768px) {
        .route-popup-overlay-container {
            position: absolute !important;
            inset: auto !important;
            top: 80px !important;
            left: 50% !important;
            transform: translateX(-50%) translateY(-20px) !important;
            width: 420px !important;
            max-width: calc(100vw - 32px) !important;
            max-height: calc(100vh - 120px) !important;
            border-radius: 20px !important;
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.3), 
                        0 0 0 1px rgba(255, 255, 255, 0.1),
                        0 0 0 4px rgba(59, 130, 246, 0.4) !important;
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(20px) !important;
            background: rgba(255, 255, 255, 0.98) !important;
        }
        
        .route-popup-overlay-container.active {
            transform: translateX(-50%) translateY(0) !important;
        }
    }
    
    /* Close Button */
    .route-popup-close-btn {
        position: absolute !important;
        top: 12px !important;
        left: 12px !important;
        width: 44px !important;
        height: 44px !important;
        background: white !important;
        border: 2px solid #e5e7eb !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 24px !important;
        font-weight: bold !important;
        color: #1f2937 !important;
        cursor: pointer !important;
        z-index: 100000 !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        transition: all 0.3s ease !important;
    }
    
    .route-popup-close-btn:hover {
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        color: white !important;
        transform: rotate(90deg) scale(1.15) !important;
        border-color: #ef4444 !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
    }
    
    @media (min-width: 768px) {
        .route-popup-close-btn {
            top: 8px !important;
            left: 8px !important;
            width: 38px !important;
            height: 38px !important;
            font-size: 22px !important;
        }
    }
    
    /* Content Padding */
    .route-popup-overlay-container > div {
        padding: 60px 16px 16px 16px !important;
    }
    
    @media (min-width: 768px) {
        .route-popup-overlay-container > div {
            padding: 50px 16px 16px 16px !important;
        }
    }
    
    /* Hide other elements when popup active */
    body.popup-active header,
    body.popup-active nav,
    body.popup-active .service-details-panel,
    body.popup-active .heatmap-control,
    body.popup-active .leaflet-control-zoom,
    body.popup-active .notifications-container {
        opacity: 0.15 !important;
        pointer-events: none !important;
        filter: blur(3px);
    }
    
    @media (min-width: 768px) {
        body.popup-active header,
        body.popup-active nav {
            opacity: 1 !important;
            filter: none !important;
        }
    }
    
    /* Scrollbar */
    .route-popup-overlay-container::-webkit-scrollbar {
        width: 8px;
    }
    
    .route-popup-overlay-container::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 10px;
    }
    
    .route-popup-overlay-container::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6, #2563eb);
        border-radius: 10px;
    }
    
    /* Animation */
    @keyframes slideUpFadeIn {
        from {
            opacity: 0;
            transform: translateY(100%);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (min-width: 768px) {
        @keyframes slideUpFadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }
    }
    
    /* ...existing code... */
</style>
