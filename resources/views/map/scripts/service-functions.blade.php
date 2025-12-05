<script>
// وظائف الخدمات والبحث
window.ServiceFunctions = {
    searchServices(query, services, projects) {
        if (query.length < 2) return [];

        const serviceResults = services.filter(s => 
            s.name.includes(query) || s.address.includes(query)
        ).map(s => ({ ...s, type: 'service' }));

        const projectResults = projects.filter(p =>
            p.name.includes(query) || p.location.includes(query)
        ).map(p => ({ ...p, type: 'project', address: p.location }));

        return [...serviceResults, ...projectResults].slice(0, 5);
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
</script>
