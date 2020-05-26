<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Typography</h1>
    <div class="mb-6">
      <form action="/api/typography" method="POST">
        <confirm-button
          message="Are you sure you want to cancel your account?"
          class="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white rounded-lg mt-5"
        >Option 1</confirm-button>
      </form>
    </div>

    <div class="mb-6">
      <form action="/api/typography" method="POST">
        <confirm-button
          message="Are you sure you want to cancel your account?"
          cancel-button="Go Back"
          confirm-button="Continue on"
          class="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white rounded-lg mt-5"
        >Option 2</confirm-button>
      </form>
    </div>

    <div class="mb-6">
      <form
        action="/api/typography"
        method="POST"
        @submit.prevent="confirm('Are you really sure about this?')"
      >
        <button class="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white rounded-lg mt-5">Option 3</button>
      </form>
    </div>

    <confirm-dialog></confirm-dialog>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted");
  },
  methods: {
    confirm(message) {
      this.$modal.dialog(message).then(confirmed => {
        if (confirmed) {
          // Proceed. Submit ajax request, etc.
          alert("Proceed");
        } else {
          // Optionally override the button visibility and labels.
          this.$modal.dialog("Okay, canceled", {
            cancelButton: "Close",
            confirmButton: false
          });
        }
      });
    }
  }
};
</script>
