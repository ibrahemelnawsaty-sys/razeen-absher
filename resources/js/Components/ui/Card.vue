<template>
  <div class="card">
    <div v-if="$slots.header" class="card-header">
      <slot name="header"></slot>
    </div>
    <div class="card-body">
      <slot />
    </div>
    <div v-if="$slots.footer" class="card-footer">
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UiCard',
};
</script>

<style scoped>
.card-header { margin-bottom: .5rem; font-weight:700; }
.card-body { margin-bottom: .5rem; }
.card-footer { margin-top: .5rem; font-size: .875rem; color: rgba(0,0,0,0.6); }
</style>
