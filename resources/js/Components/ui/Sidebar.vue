<template>
  <aside :class="['sidebar', { open: isOpen }]" aria-hidden="!isOpen">
    <div class="sidebar-header">
      <slot name="title">Layers & Filters</slot>
      <button class="btn btn-secondary" @click="$emit('toggle')">Close</button>
    </div>
    <div class="sidebar-content">
      <slot />
    </div>
  </aside>
</template>

<script>
export default {
  name: 'UiSidebar',
  props: {
    isOpen: { type: Boolean, default: true },
  },
};
</script>

<style scoped>
.sidebar {
  width: 320px;
  max-width: 90vw;
  background: var(--color-secondary-bg);
  border-left: 1px solid rgba(0,0,0,0.04);
  padding: 1rem;
  box-shadow: var(--card-shadow);
  transition: transform .18s ease;
  transform: translateX(0);
}
.sidebar[aria-hidden="true"],
.sidebar:not(.open) { transform: translateX(-110%); }
.sidebar-header { display:flex; justify-content:space-between; align-items:center; margin-bottom: .75rem; }
.sidebar-content { max-height: calc(100vh - 120px); overflow:auto; }
</style>
