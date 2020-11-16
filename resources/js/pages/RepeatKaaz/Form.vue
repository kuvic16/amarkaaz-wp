<template>
  <div>
    <!-- <form
      class="mt-10"
      @submit.prevent="onSubmit"
      @keydown="repeat_kaaz.errors.clear($event.target.name)"
    >
      <div class="flex flex-wrap">
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-task-name"
          >Task Name</label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="grid-task-name"
            type="text"
            placeholder="Ex. Exercise"
            v-model="repeat_kaaz.name"
            required
          />
          <p
            class="text-red-500 text-xs italic"
            v-if="repeat_kaaz.errors.has('name')"
            v-text="repeat_kaaz.errors.get('name')"
          ></p>
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-task-name"
          >Tags</label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="grid-task-name"
            type="text"
            placeholder="Ex. Focusing"
            v-model="repeat_kaaz.tags"
            required
          />
          <p
            class="text-red-500 text-xs italic"
            v-if="repeat_kaaz.errors.has('tags')"
            v-text="repeat_kaaz.errors.get('tags')"
          ></p>
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-task-type"
          >Type</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.type_id"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="kaaz_type in kaaz_type_list" v-bind:value="kaaz_type.id" v-text="kaaz_type.name"></option>            
            </select>
          </div>          
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >Repeat Policy:</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.repeat_policy"
              @change="onPolicyChangeListener($event)"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option value="weekday">Weekday</option>
              <option value="daily">Daily</option>
              <option value="weekend">Weekend</option>
              <option value="monthly">Monthly</option>
              <option value="yearly">Yearly</option>
            </select>
          </div>
        </div>
        <div
          v-if="repeat_kaaz.repeat_policy == 'yearly'"
          class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4"
        >
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >Start Month</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.start_month"
              @change="onStartMonthChangeListener(repeat_kaaz.start_month)"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="(month, key) in months" :value="key">{{month}}</option>
            </select>
          </div>
        </div>
        <div
          v-if="
            repeat_kaaz.repeat_policy == 'yearly' ||
              repeat_kaaz.repeat_policy == 'monthly'
          "
          class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4"
        >
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >Start Day</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.start_day"
              @change="onStartDayChangeListener(repeat_kaaz.start_day)"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="day in days" v-text="day"></option>
            </select>
          </div>
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >Start Time</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.start_time"
              @change="onStartTimeChangeListener()"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="time in start_times" v-text="time"></option>
            </select>
          </div>
        </div>
        <div
          v-if="repeat_kaaz.repeat_policy == 'yearly'"
          class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4"
        >
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >End Month</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.end_month"
              @change="onEndMonthChangeListener(repeat_kaaz.end_month)"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="(month, key) in months" :value="key">{{month}}</option>
            </select>
          </div>
        </div>
        <div
          v-if="
            repeat_kaaz.repeat_policy == 'yearly' ||
              repeat_kaaz.repeat_policy == 'monthly'
          "
          class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4"
        >
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >End Day</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.end_day"
              @change="onEndDayChangeListener(repeat_kaaz.end_day)"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="day in days" v-text="day"></option>
            </select>
          </div>
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >End Time</label>
          <div class="relative">
            <select
              v-model="repeat_kaaz.end_time"
              @change="onEndTimeChangeListener()"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
            >
              <option v-for="time in end_times" v-text="time"></option>
            </select>
          </div>
        </div>
        <div class="px-3 w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4">
          <button
            class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
          >Save</button>
        </div>
      </div>
    </form> -->

    <form
      class="mt-10"
      @submit.prevent="onSubmit"
      @keydown="repeat_kaaz.errors.clear($event.target.name)"
    >
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
            >
              <div
                class="px-4 py-5 border-b border-gray-200 sm:px-6 bg-blueviolet"
              >
                <div class="flex mb-4">
                  <div class="w-1/2">
                    <h3 class="text-lg leading-6 font-medium text-white">
                      New Repeat Task
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-white">
                      The task you do periodically
                    </p>
                  </div>
                </div>
              </div>
              <div class="px-4 py-5 bg-white sm:p-6">
                <!-- <div
                  v-if="isError"
                  class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3"
                  role="alert"
                >
                  <strong class="font-bold">Error:</strong>
                  <span class="block sm:inline" v-text="errorMessage"></span>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg
                      class="fill-current h-6 w-6 text-red-500"
                      role="button"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <title>Close</title>
                      <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                      />
                    </svg>
                  </span>
                </div> -->
                <ErrorAlert v-if="isError" message="errorMessage" />
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                    <label
                      for="task-name"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Task Name</label
                    >
                    <input
                      id="task-name"
                      class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      placeholder="Ex. Exercise"
                      v-model="repeat_kaaz.name"
                      required
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label
                      for="kaaz-type"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Type</label
                    >
                    <select
                      v-model="repeat_kaaz.type_id"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="kaaz-type"
                    >
                      <option
                        v-for="kaaz_type in kaaz_type_list"
                        v-bind:value="kaaz_type.id"
                        v-text="kaaz_type.name"
                      ></option>
                    </select>
                  </div>

                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label
                      for="kaaz-policy"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Repeat Policy</label
                    >
                    <select
                      v-model="repeat_kaaz.repeat_policy"
                      @change="onPolicyChangeListener($event)"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="kaaz-policy"
                    >
                      <option value="weekday">Weekday</option>
                      <option value="daily">Daily</option>
                      <option value="weekend">Weekend</option>
                      <option value="monthly">Monthly</option>
                      <option value="yearly">Yearly</option>
                    </select>
                  </div>

                  <div
                    v-if="repeat_kaaz.repeat_policy == 'yearly'"
                    class="col-span-6 sm:col-span-3 lg:col-span-2"
                  >
                    <label
                      for="start-month"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Start Month</label
                    >
                    <select
                      v-model="repeat_kaaz.start_month"
                      @change="
                        onStartMonthChangeListener(repeat_kaaz.start_month)
                      "
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="start-month"
                    >
                      <option v-for="(month, key) in months" :value="key">
                        {{ month }}
                      </option>
                    </select>
                  </div>

                  <div
                    v-if="
                      repeat_kaaz.repeat_policy == 'yearly' ||
                        repeat_kaaz.repeat_policy == 'monthly'
                    "
                    class="col-span-6 sm:col-span-3 lg:col-span-2"
                  >
                    <label
                      for="start-day"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Start Day</label
                    >
                    <select
                      v-model="repeat_kaaz.start_day"
                      @change="onStartDayChangeListener(repeat_kaaz.start_day)"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="start-day"
                    >
                      <option v-for="day in days" v-text="day"></option>
                    </select>
                  </div>

                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label
                      for="start-time"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >Start Time</label
                    >
                    <select
                      v-model="repeat_kaaz.start_time"
                      @change="onStartTimeChangeListener()"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="start-time"
                    >
                      <option
                        v-for="time in start_times"
                        v-text="time"
                      ></option>
                    </select>
                  </div>

                  <div
                    v-if="repeat_kaaz.repeat_policy == 'yearly'"
                    class="col-span-6 sm:col-span-3 lg:col-span-2"
                  >
                    <label
                      for="end-month"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >End Month</label
                    >
                    <select
                      v-model="repeat_kaaz.end_month"
                      @change="onEndMonthChangeListener(repeat_kaaz.end_month)"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="end-month"
                    >
                      <option v-for="(month, key) in months" :value="key">
                        {{ month }}
                      </option>
                    </select>
                  </div>

                  <div
                    v-if="
                      repeat_kaaz.repeat_policy == 'yearly' ||
                        repeat_kaaz.repeat_policy == 'monthly'
                    "
                    class="col-span-6 sm:col-span-3 lg:col-span-2"
                  >
                    <label
                      for="end-day"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >End Day</label
                    >
                    <select
                      v-model="repeat_kaaz.end_day"
                      @change="onEndDayChangeListener(repeat_kaaz.end_day)"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="end-day"
                    >
                      <option v-for="day in days" v-text="day"></option>
                    </select>
                  </div>

                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label
                      for="end-time"
                      class="block text-sm font-medium leading-5 text-gray-700"
                      >End Time</label
                    >
                    <select
                      v-model="repeat_kaaz.end_time"
                      @change="onEndTimeChangeListener()"
                      class="rk-select mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      id="end-time"
                    >
                      <option v-for="time in end_times" v-text="time"></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <router-link
                  to="/repeat-kaaz"
                  class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 shadow-sm hover:bg-gray-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out"
                >
                  Cancel
                </router-link>
                <button
                  class="ml-2 py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out"
                >
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import moment from "moment";
import Form from "../../core/Form.js";

export default {
  mounted() {
    //this.repeat_kaaz = this.new_repeat_kaaz_form();
    this.populateDays(moment().daysInMonth());
    this.populateTimes();
    var minute = parseInt(moment().format("mm"));
    var hour = parseInt(moment().format("hh"));
    var amPm = moment().format("a");
    this.getPossibleCurrentTime(hour, minute, amPm);
  },
  created() {
    this.loadInitData();
    this.getList();
  },
  data: function() {
    return {
      repeat_kaaz: new Form({
        name: "",
        tags: "",
        type_id: "0",
        repeat_policy: "daily",
        start_month: parseInt(moment().format("M")),
        start_day: moment().format("D"),
        start_time: moment().format("hh:mm A"),
        end_month: parseInt(moment().format("M")),
        end_day: moment().format("D"),
        end_time: moment().format("hh:mm A"),
      }),
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
      days: [],
      start_times: [],
      end_times: [],
      token: "",
      message: "",
      kaaz_type_list: [],
      repeat_kaaz_list: [],
      isError: false,
      errorMessage: "",
    };
  },
  methods: {
    new_repeat_kaaz_form() {
      this.repeat_kaaz = new Form({
        name: "",
        tags: "",
        type_id: "0",
        repeat_policy: "daily",
        start_month: parseInt(moment().format("M")),
        start_day: moment().format("D"),
        start_time: moment().format("hh:mm A"),
        end_month: parseInt(moment().format("M")),
        end_day: moment().format("D"),
        end_time: moment().format("hh:mm A"),
      });
    },

    /**
     * Generate days list of specific month using moment
     *
     * @param {int} month
     * @return {void}
     */
    generateDaysOfMonth(month) {
      this.populateDays(moment(month, "M").daysInMonth());
    },

    /**
     * Populate array list from number of days
     *
     * @param {int} noOfDays
     * @return {void}
     */
    populateDays(noOfDays) {
      this.days = [];
      for (var i = 1; i <= noOfDays; i++) {
        this.days.push(i);
      }
    },

    /**
     * Get possible current time to adjust in time dropdown
     *
     * @return {void}
     */
    getPossibleCurrentTime(hour, minute, amPm) {
      if (minute > 0 && minute < 15) minute = 15;
      if (minute > 15 && minute < 30) minute = 30;
      if (minute > 30 && minute < 45) minute = 45;
      if (minute > 45) {
        if (hour == 11) {
          amPm = amPm == "am" ? "pm" : "am";
        }
        if (hour == 12) {
          hour = 1;
        } else {
          hour += 1;
          minute = 0;
        }
        minute = 0;
      }
      this.repeat_kaaz.start_time =
        this.pad(hour) + ":" + this.pad(minute) + amPm;

      this.populateEndTime(minute, hour, amPm);

      // console.log("Start Time: " + this.repeat_kaaz.start_time);
    },

    populateEndTime(minute, hour, amPm) {
      minute += 15;
      if (minute > 0 && minute < 15) minute = 15;
      if (minute > 15 && minute < 30) minute = 30;
      if (minute > 30 && minute < 45) minute = 45;
      if (minute > 45) {
        if (hour == 11) {
          amPm = amPm == "am" ? "pm" : "am";
        }
        if (hour == 12) {
          hour = 1;
        } else {
          hour += 1;
          minute = 0;
        }
      }

      this.repeat_kaaz.end_time =
        this.pad(hour) + ":" + this.pad(minute) + amPm;

      //console.log("End Time: " + this.repeat_kaaz.end_time);
    },

    /**
     * Populate times array of the current day
     *
     * @return {void}
     */
    populateTimes() {
      this.start_times = ["12:00am", "12:15am", "12:30am", "12:45am"];
      for (var i = 1; i < 12; i++) {
        this.start_times.push(this.pad(i) + ":00am");
        this.start_times.push(this.pad(i) + ":15am");
        this.start_times.push(this.pad(i) + ":30am");
        this.start_times.push(this.pad(i) + ":45am");
      }

      this.start_times.push("12:00pm", "12:15pm", "12:30pm", "12:45pm");
      for (var i = 1; i < 12; i++) {
        this.start_times.push(this.pad(i) + ":00pm");
        this.start_times.push(this.pad(i) + ":15pm");
        this.start_times.push(this.pad(i) + ":30pm");
        this.start_times.push(this.pad(i) + ":45pm");
      }

      this.end_times = ["12:00am", "12:15am", "12:30am", "12:45am"];
      for (var i = 1; i < 12; i++) {
        this.end_times.push(this.pad(i) + ":00am");
        this.end_times.push(this.pad(i) + ":15am");
        this.end_times.push(this.pad(i) + ":30am");
        this.end_times.push(this.pad(i) + ":45am");
      }

      this.end_times.push("12:00pm", "12:15pm", "12:30pm", "12:45pm");
      for (var i = 1; i < 12; i++) {
        this.end_times.push(this.pad(i) + ":00pm");
        this.end_times.push(this.pad(i) + ":15pm");
        this.end_times.push(this.pad(i) + ":30pm");
        this.end_times.push(this.pad(i) + ":45pm");
      }
    },

    /**
     * Padding 0 of any single disit number
     *
     * @param {int} number
     * @return {int}
     */
    pad(number) {
      return number < 10 ? "0" + number : number;
    },

    /**
     * On policy on change listener
     *
     * @param {event} event
     * @return {void}
     */
    onPolicyChangeListener(event) {},

    /**
     * On Start month change listener method
     *
     * @param {int} month
     * @return {void}
     */
    onStartMonthChangeListener(month) {
      this.generateDaysOfMonth(month);
      this.repeat_kaaz.end_month = month;
    },

    /**
     * On Last month change listener method
     *
     * @param {int} month
     * @return {void}
     */
    onEndMonthChangeListener(month) {
      this.generateDaysOfMonth(month);
      if (this.repeat_kaaz.end_month < this.repeat_kaaz.start_month) {
        this.repeat_kaaz.start_month = month;
      }
    },

    /**
     * On Start day change listener method
     *
     * @param {int} day
     * @return {void}
     */
    onStartDayChangeListener(day) {
      this.repeat_kaaz.end_day = day;
    },

    /**
     * On Last day change listener method
     *
     * @param {int} day
     * @return {void}
     */
    onEndDayChangeListener(day) {
      //console.log("day: " + day);
      //console.log("end day: " + this.repeat_kaaz.end_day);
      //console.log("start day: " + this.repeat_kaaz.start_day);
      //console.log("repeat policy: " + this.repeat_kaaz.repeat_policy);
      console.log("start month: " + this.repeat_kaaz.start_month);

      if (
        this.repeat_kaaz.repeat_policy == "yearly" &&
        parseInt(this.repeat_kaaz.end_month) ==
          parseInt(this.repeat_kaaz.start_month) &&
        parseInt(this.repeat_kaaz.end_day) <
          parseInt(this.repeat_kaaz.start_day)
      ) {
        this.repeat_kaaz.start_day = day;
      }

      if (
        this.repeat_kaaz.repeat_policy == "monthly" &&
        parseInt(this.repeat_kaaz.end_day) <
          parseInt(this.repeat_kaaz.start_day)
      ) {
        this.repeat_kaaz.start_day = day;
      }
    },

    /**
     * On Start time change listener method
     *
     * @param {string} time
     * @return {void}
     */
    onStartTimeChangeListener() {
      var selectedTime = this.repeat_kaaz.start_time;
      if (selectedTime) {
        var minute = parseInt(selectedTime.slice(3, 5));
        var hour = parseInt(selectedTime.slice(0, 2));
        var amPm = selectedTime.slice(5, 7);
        this.populateEndTime(minute, hour, amPm);
      }
    },

    /**
     * On End time change listener method
     *
     * @param {string} time
     * @return {void}
     */
    onEndTimeChangeListener(time) {
      var selectedStartTime = this.repeat_kaaz.start_time;
      var selectedEndTime = this.repeat_kaaz.end_time;
      //console.log("s: " + selectedStartTime);
      //console.log("e: " + selectedEndTime);

      if (selectedEndTime && selectedStartTime) {
        var endMinute = parseInt(selectedEndTime.slice(3, 5));
        var endHour = parseInt(selectedEndTime.slice(0, 2));
        var endAmPm = selectedEndTime.slice(5, 7);

        var selectedStartTime = this.repeat_kaaz.start_time;
        var startMinute = parseInt(selectedStartTime.slice(3, 5));
        var startHour = parseInt(selectedStartTime.slice(0, 2));
        var startAmPm = selectedStartTime.slice(5, 7);

        //console.log(startHour + "-" + startMinute + "-" + startAmPm);
        //console.log(endHour + "-" + endMinute + "-" + endAmPm);

        if (
          endHour < startHour ||
          (endHour == startHour && endMinute < startMinute)
        ) {
          this.repeat_kaaz.start_time =
            this.pad(endHour) + ":" + this.pad(endMinute) + endAmPm;
        }
      }
    },

    /**
     * Save repeat kaaz
     *
     * @return {void}
     */
    saveRepeatKaaz() {
      //console.log(this.repeat_kaaz);
    },

    /**
     * Load init repeat kaaz data
     */
    loadInitData() {
      axios
        .get(this.wp_url + "?action=amar_kaaz_repeatkaaz/init")
        .then((response) => response.data)
        .then((data) => {
          this.kaaz_type_list = data.data.kaaz_type_list;
          if (this.kaaz_type_list.length > 0) {
            this.repeat_kaaz.type_id = this.kaaz_type_list[0].id;
          }
        });
    },

    /**
     * Get the list of repeat kaaz
     */
    getList() {
      axios
        .get(this.wp_url + "?action=amar_kaaz_repeatkaaz")
        .then((response) => response.data)
        .then((data) => {
          console.log(data);
          this.repeat_kaaz_list = data.data.repeat_kaaz_list;
        });
    },

    /**
     * Save the new repeat kaaz
     */
    onSubmit() {
      this.repeat_kaaz
        .submit("post", this.wp_url + "?action=amar_kaaz_repeatkaaz")
        .then((data) => {
          console.log(data);
          if (data.success == true) {
            this.getList();
            this.new_repeat_kaaz_form();
          } else {
            this.isError = true;
            this.errorMessage = data.data.message;
          }
        })
        .catch((errors) => console.log(errors));
    },
  },
};
</script>
<style lang="">
.rk-select {
  line-height: 20px !important;
  padding: 8px 12px 8px 12px !important;

  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
  border-radius: 0.375rem !important;
  color: rgb(68, 68, 68) !important;
  border-color: rgba(226, 232, 240, var(--border-opacity)) !important;
}

.rk-select:focus {
  border-color: #90cdf4 !important;
}
</style>
