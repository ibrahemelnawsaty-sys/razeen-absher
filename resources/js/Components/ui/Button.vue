<template>
  <button
    :class="['btn', variantClass, { disabled: disabled }]"
    :aria-disabled="disabled ? 'true' : 'false'"
    @click="onClick"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'UiButton',
  props: {
    variant: { type: String, default: 'primary' }, // primary | secondary
    disabled: { type: Boolean, default: false },
  },
  computed: {
    variantClass() {
      return this.variant === 'secondary' ? 'btn-secondary' : 'btn-primary';
    },
  },
  methods: {
    onClick(event) {
      if (this.disabled) return;
      this.$emit('click', event);
    },
  },
};
</script>

<style scoped>
/* reuse CSS variables from resources/css/app.css */
.btn.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>
