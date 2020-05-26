<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Illustrations</h1>
    <div class="bg-gray-400 w-64 h-64 flex items-center justify-center">
      <dropdown>
        <template v-slot:trigger>
          <button>...</button>
        </template>

        <li>
          <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Edit</a>
        </li>
        <li>
          <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Delete</a>
        </li>
        <li>
          <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Report</a>
        </li>
      </dropdown>
    </div>

    <hr />

    <dropdown classes="w-full">
      <template v-slot:trigger>
        <button>Click Me for More Options</button>
      </template>

      <li>
        <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Edit</a>
      </li>
      <li>
        <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Delete</a>
      </li>
      <li>
        <a href="#" class="pl-2 pr-8 leading-loose text-xs block hover:bg-gray-900">Report</a>
      </li>
    </dropdown>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted");
  }
};
</script>
