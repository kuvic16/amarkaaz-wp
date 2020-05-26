<template>
  <div>
    <modal name="dialog">
      {{ params.message }}
      <template v-slot:footer>
        <button
          class="bg-gray-500 hover:bg-gray-600 py-2 px-4 text-white rounded-lg mr-2"
          @click.prevent="handleClick(false)"
          v-if="params.cancelButton"
          v-text="params.cancelButton"
        ></button>
        <button
          class="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white rounded-lg"
          @click.prevent="handleClick(true)"
          v-if="params.confirmButton"
          v-text="params.confirmButton"
        ></button>
      </template>
    </modal>
  </div>
</template>

<script>
import Modal from "../plugins/modal/ModalPlugin";
export default {
  data() {
    return {
      params: {
        message: "Are you sure?",
        confirmButton: "Continue",
        cancelButton: "Cancel"
      }
    };
  },
  beforeMount() {
    // $vm0.confirm('Are you there?');
    // listen for that event
    // fetch the process
    // and assign it to the data object
    Modal.events.$on("show", params => {
      //this.message = params.message;
      Object.assign(this.params, params);
    });
  },
  methods: {
    handleClick(confirmed) {
      Modal.events.$emit("clicked", confirmed);

      this.$modal.hide();
    }
  }
};
</script>