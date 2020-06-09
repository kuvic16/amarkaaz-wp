<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Logo Symbol</h1>
    <h1 class="text-2xl font-bold mb-6">Tabs</h1>
    <tabs>
      <tab title="First">
        <p>Hello world.</p>
      </tab>
      <tab title="Second">
        <p>Hello world again.</p>
      </tab>
      <tab title="Third">
        <p>Hello world and out.</p>
      </tab>
      <tab title="Wew" active>
        <p>It works!</p>
      </tab>
    </tabs>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("about page mounted");
  }
};
</script>
