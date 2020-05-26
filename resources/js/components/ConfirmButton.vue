<template>
  <button @click="confirm">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    message: {},
    confirmButton: { default: "Continue" },
    cancelButton: { default: "Cancel" }
  },
  data() {
    return { confirmed: false };
  },
  methods: {
    confirm(e) {
      if (this.confirmed) {
        return;
      }
      e.preventDefault();

      this.$modal.dialog(this._props).then(confirmed => {
        this.confirmed = confirmed;
        if (confirmed) {
          this.$el.click();
        } else {
          this.$modal.dialog("Okay, canceled.");
        }
      });
    }
  }
};
</script>