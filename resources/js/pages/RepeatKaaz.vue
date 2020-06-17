<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Repeat Kaaz</h1>

    <form class="mt-10">
      <!-- <div class="w-full flex">
        <div class="w-1/3"></div>
      </div>-->
      <div class="w-full flex">
        <div class="w-2/4">
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
                  <option>Weekday</option>
                  <option>Weekend</option>
                  <option>Monthly</option>
                  <option>Yearly</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >Start Month</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                  <option>May</option>
                </select>
              </div>
            </div>
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >Start Day</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >Start Time</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>12:00 AM</option>
                  <option>12:30 AM</option>
                  <option>01:00 AM</option>
                  <option>01:30 AM</option>
                  <option>02:00 AM</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >End Month</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                  <option>May</option>
                </select>
              </div>
            </div>
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >End Day</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
            <div class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >End Time</label>
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option>12:00 AM</option>
                  <option>12:30 AM</option>
                  <option>01:00 AM</option>
                  <option>01:30 AM</option>
                  <option>02:00 AM</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="w-2/4 ml-10">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >All Repeat Tasks</label>
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="border text-left px-4 py-2 w-2/4">Name</th>
                <th class="border text-left px-4 py-2 w-1/4">Start Time</th>
                <th class="border text-left px-4 py-2 w-1/4">End Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border px-4 py-2">Fazar</td>
                <td class="border px-4 py-2">4:00 AM</td>
                <td class="border px-4 py-2">4:30 AM</td>
              </tr>
              <tr class="bg-gray-100">
                <td class="border px-4 py-2">Johor</td>
                <td class="border px-4 py-2">1:00 PM</td>
                <td class="border px-4 py-2">2:00 PM</td>
              </tr>
              <tr>
                <td class="border px-4 py-2">Asor</td>
                <td class="border px-4 py-2">4:00 PM</td>
                <td class="border px-4 py-2">5:00 PM</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="w-full flex">
        <div class="w-1/3 ml-auto text-right">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
          >Save</button>
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
