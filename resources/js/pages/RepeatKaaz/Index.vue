<template>
  <div>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <div
              class="px-4 py-5 border-b border-gray-200 sm:px-6 bg-cadetblue"
            >
              <div class="flex mb-4">
                <div class="w-1/2">
                  <h3 class="text-lg leading-6 font-medium text-white">
                    Repeat Task
                  </h3>
                  <p class="mt-1 max-w-2xl text-sm leading-5 text-white">
                    The task you do periodically
                  </p>
                  <p class="mt-1 max-w-2xl text-sm leading-5 text-white">
                    Total: {{ repeat_kaaz.total }}
                  </p>
                </div>
                <div class="w-1/2 text-right">
                  <span class="inline-flex rounded-md shadow-sm">
                    <router-link
                      to="/repeat-kaaz/form"
                      class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 hover:text-white focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                    >
                      <plus-icon></plus-icon>
                      Create
                    </router-link>
                  </span>
                </div>
              </div>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Name
                  </th>
                  <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Start
                  </th>
                  <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                  >
                    End
                  </th>
                  <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                  >
                    Status
                  </th>
                  <th class="px-6 py-3 bg-gray-50">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr
                  v-for="repeat_kaaz in repeat_kaaz.data"
                  :key="repeat_kaaz.id"
                >
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="flex items-center">
                      <div class="">
                        <div
                          class="text-sm leading-5 font-medium text-gray-900"
                        >
                          {{ repeat_kaaz.name }}
                        </div>
                        <div class="text-sm leading-5 text-gray-500">
                          {{ repeat_kaaz.kaaz_type_name }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="text-sm leading-5 text-gray-900">
                      {{ repeat_kaaz.start_time }}
                      {{
                        repeat_kaaz.repeat_policy == "yearly" ||
                        repeat_kaaz.repeat_policy == "monthly"
                          ? " at " + repeat_kaaz.start_day
                          : ""
                      }}
                      {{
                        repeat_kaaz.repeat_policy == "yearly"
                          ? months[repeat_kaaz.start_month]
                          : ""
                      }}
                    </div>
                    <div class="text-sm leading-5 text-gray-500 capitalize">
                      {{ repeat_kaaz.repeat_policy }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="text-sm leading-5 text-gray-900">
                      {{ repeat_kaaz.end_time }}
                      {{
                        repeat_kaaz.repeat_policy == "yearly" ||
                        repeat_kaaz.repeat_policy == "monthly"
                          ? " at " + repeat_kaaz.end_day
                          : ""
                      }}
                      {{
                        repeat_kaaz.repeat_policy == "yearly"
                          ? months[repeat_kaaz.end_month]
                          : ""
                      }}
                    </div>
                    <div class="text-sm leading-5 text-gray-500 capitalize">
                      {{ repeat_kaaz.repeat_policy }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <span
                      v-if="repeat_kaaz.active == 1"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-800 text-white"
                    >
                      Active
                    </span>
                    <span
                      v-if="repeat_kaaz.active == 0"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white"
                    >
                      Inactive
                    </span>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-no-wrap text-center text-sm leading-5 font-medium"
                  >
                    <router-link
                      v-bind:to="'/repeat-kaaz/form?id=' + repeat_kaaz.id"
                      class="text-indigo-600 hover:text-indigo-900"
                      >Edit</router-link
                    >

                    <a
                      href="#"
                      v-on:click="openDeleteDialog(repeat_kaaz.id)"
                      class="text-red-600 hover:text-red-900"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
            <div
              class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
            >
              <div class="flex-1 flex justify-between">
                <button
                  :disabled="!repeat_kaaz.has_prev"
                  v-bind:class="{ 'not-allowed': !repeat_kaaz.has_prev }"
                  @click="prev()"
                  class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                >
                  Previous
                </button>
                <div class="items-center">
                  <div>
                    <p class="text-sm leading-5 text-gray-700">
                      Showing
                      <span class="font-medium">{{ repeat_kaaz.from }}</span>
                      to
                      <span class="font-medium">{{ repeat_kaaz.to }}</span>
                      of
                      <span class="font-medium">{{ repeat_kaaz.total }}</span>
                      results
                    </p>
                  </div>
                </div>
                <button
                  :disabled="!repeat_kaaz.has_next"
                  v-bind:class="{ 'not-allowed': !repeat_kaaz.has_next }"
                  @click="next()"
                  class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                >
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";
import Modal from "../../plugins/modal/ModalPlugin";
import PlusIcon from "../../components/icons/PlusIcon.vue";

export default {
  components: {
    Modal,
    PlusIcon,
  },
  mounted() {},
  created() {
    this.getList();
  },
  data: function() {
    return {
      repeat_kaaz: {
        total: 0,
        data: [],
        page: 1,
        from: 1,
        to: 6,
        has_next: false,
        has_prev: false,
      },
      months: {
        1: "January",
        2: "February",
        3: "March",
        4: "April",
        5: "May",
        6: "June",
        7: "July",
        8: "August",
        9: "September",
        10: "October",
        11: "November",
        12: "December",
      },
    };
  },
  methods: {
    /**
     * Get the list of repeat kaaz
     */
    getList() {
      var params = "&page=" + this.repeat_kaaz.page;
      axios
        .get(this.wp_url + "?action=amar_kaaz_repeatkaaz" + params)
        .then((response) => response.data)
        .then((data) => {
          this.repeat_kaaz = data.data.repeat_kaaz;
          console.log(this.repeat_kaaz);
        });
    },
    next: function() {
      this.repeat_kaaz.page += 1;
      this.getList();
    },
    prev: function() {
      this.repeat_kaaz.page -= 1;
      this.getList();
    },
    openDeleteDialog: function(id) {
      if (confirm("Are you sure to delete?")) {
        var params = "&id=" + id;
        axios
          .delete(this.wp_url + "?action=amar_kaaz_repeatkaaz" + params)
          .then((response) => response.data)
          .then((data) => {
            this.getList();
          });
      }
    },
  },
};
</script>
<style>
.not-allowed {
  cursor: not-allowed;
}
</style>
