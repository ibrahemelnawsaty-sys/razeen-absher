<script>
// وظائف الواجهة والإشعارات
window.UIFunctions = {
    showNotification(notifications, notification) {
        const id = Date.now();
        notifications.push({ id, ...notification });
        setTimeout(() => {
            const index = notifications.findIndex(n => n.id === id);
            if (index > -1) notifications.splice(index, 1);
        }, 5000);
    },

    useGPS(successCallback, errorCallback) {
        if (!navigator.geolocation) {
            errorCallback('المتصفح لا يدعم تحديد الموقع');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => successCallback(position.coords.latitude, position.coords.longitude),
            () => errorCallback('فشل تحديد الموقع')
        );
    }
};
</script>
