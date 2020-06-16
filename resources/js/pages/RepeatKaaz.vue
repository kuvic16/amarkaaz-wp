<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Repeat Kaaz</h1>

    <form class="w-1/3 max-w-lg mt-10">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-task-name"
          >Task Name</label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="grid-task-name"
            type="text"
            placeholder="Ex. Exercise"
          />
          <p class="text-red-500 text-xs italic">Please fill out this field.</p>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-task-type"
          >Type</label>
          <label>
            <input class id="grid-city" type="radio" name="task-type" />
            Nice to have
          </label>
          <label class="ml-2">
            <input class id="grid-city" type="radio" name="task-type" />
            Must to have
          </label>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >Repeat Policy</label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option>Daily</option>
              <option>Monthly</option>
              <option>Yearly</option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted");
  }
};
</script>
