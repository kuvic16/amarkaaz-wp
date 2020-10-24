<template>
  <div :id="name" class="form-modal-overlay text-left">
    <div class="form-modal">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: ["name"]
};
</script>

<style>
.form-modal-overlay {
  visibility: hidden;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.4);
  transition: opacity 0.3s;
  opacity: 0;
}

.form-modal-overlay:target {
  visibility: visible;
  opacity: 1;
}

.form-modal {
  position: relative;
  width: 600px;
  height: 500px;
  max-width: 80%;
  background: white;
  border-radius: 4px;
  padding: 2px;
  box-shadow: 0 5px 11px rgba(36, 37, 38, 0.08);
  overflow-y: auto;
}

.form-modal .close {
  position: absolute;
  top: 15px;
  right: 15px;
  color: grey;
  text-decoration: none;
}
</style>