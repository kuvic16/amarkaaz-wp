<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Mascot</h1>

    <scroll-link href="#categories" class="text-blue-500">Go To Testimonials</scroll-link>

    <div style="height: 1000px"></div>
    <div id="categories">
      <h2 class="font-bold mb-6">Testimonials</h2>
      <div class="flex">
        <div class="w-1/3 h-48 bg-gray-200 p-4">
          <scroll-link href="#app" class="text-blue-500">Go Back Up</scroll-link>
        </div>
        <div class="w-1/3 h-48 bg-gray-400 p-4">Item</div>
        <div class="w-1/3 h-48 bg-gray-200 p-4">Item</div>
      </div>
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
