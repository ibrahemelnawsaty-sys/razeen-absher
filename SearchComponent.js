<template>
  <div class="search-container">
    <div class="search-bar">
      <input
        v-model="query"
        type="text"
        placeholder="ابحث عن مركز، طريق، طوارئ أو مشروع..."
        class="search-input"
        @keyup.enter="performSearch"
      />
      <button class="search-button" @click="performSearch">
        <span v-if="loading">⏳</span>
        <span v-else>🔍</span>
      </button>
    </div>
    <div v-if="results.length" class="search-results">
      <ul>
        <li
          v-for="result in results"
          :key="result.id"
          @click="selectResult(result)"
          class="search-result-item"
        >
          <strong>{{ result.name }}</strong>
          <p class="text-sm text-gray-500">{{ result.type }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchComponent',
  data() {
    return {
      query: '',
      results: [],
      loading: false,
    };
  },
  methods: {
    async performSearch() {
      if (!this.query.trim()) return;

      this.loading = true;
      try {
        const response = await fetch(`/api/search?q=${this.query}`);
        if (response.ok) {
          this.results = await response.json();
        } else {
          console.error('Search failed');
        }
      } catch (error) {
        console.error('Error performing search:', error);
      } finally {
        this.loading = false;
      }
    },
    selectResult(result) {
      this.$emit('result-selected', result);
    },
  },
};
</script>
