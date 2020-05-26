<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Wallpapers</h1>

    <div class="text-center">
      <h1 class="text-2xl font-bold mb-8">Modal</h1>
      <p>
        <a href="#cancel-modal" class="text-blue-500 underline">Open Modal</a>
      </p>

      <modal name="cancel-modal">
        <h1>Leaving So Soon?</h1>
        <p>
          Hello Mister how are you? what are learning now alone.
          We are in corantaine for 2 months without job.
        </p>
        <template v-slot:footer>
          <button
            @click="$modal.hide('cancel-modal')"
            class="bg-gray-500 py-2 px-4 rounded-lg text-white hover:bg-gray-600 mr-2"
          >Cancel</button>
          <a
            href="#confirm-cancel-modal"
            class="bg-blue-500 py-2 px-4 rounded-lg text-white hover:bg-blue-600 mr-2"
          >Confirm Cancellation</a>
        </template>
      </modal>

      <modal name="confirm-cancel-modal">
        <h1>Your're 100% Sure?</h1>
        <p>
          Hello Mister how are you? what are learning now alone.
          We are in corantaine for 2 months without job.
        </p>
        <template v-slot:footer>
          <a
            href="#"
            class="bg-gray-500 py-2 px-4 rounded-lg text-white hover:bg-gray-600 mr-2"
          >Cancel</a>
          <a href="#" class="bg-blue-500 py-2 px-4 rounded-lg text-white hover:bg-blue-600 mr-2">Yes</a>
        </template>
      </modal>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted");
  }
};
</script>
