<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Repeat Kaaz</h1>

    <form class="mt-10">
      <div class="w-full flex">
        <div class="w-1/3">
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
                for="grid-task-name"
              >Tags</label>
              <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="grid-task-name"
                type="text"
                placeholder="Ex. Focusing"
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
              >Repeat Policy:</label>
              <div class="relative">
                <select
                  v-model="repeat_kaaz.repeat_policy"
                  @change="onPolicyChange($event)"
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
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div v-if="repeat_kaaz.repeat_policy == 'yearly'" class="w-1/3 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >Start Month</label>
              <div class="relative">
                <select
                  v-model="repeat_kaaz.start_month"
                  @change="generateDaysOfMonth(repeat_kaaz.start_month)"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="month in months" v-text="month"></option>
                </select>
              </div>
            </div>
            <div
              v-if="repeat_kaaz.repeat_policy == 'yearly' || repeat_kaaz.repeat_policy == 'monthly'"
              class="w-1/3 px-3"
            >
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >Start Day</label>
              <div class="relative">
                <select
                  v-model="repeat_kaaz.start_day"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="day in days" v-text="day"></option>
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
                  v-model="repeat_kaaz.start_time"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="time in start_times" v-text="time"></option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/3 px-3" v-if="repeat_kaaz.repeat_policy == 'yearly'">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >End Month</label>
              <div class="relative">
                <select
                  v-model="repeat_kaaz.end_month"
                  @change="generateDaysOfMonth(repeat_kaaz.start_month)"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="month in months" v-text="month"></option>
                </select>
              </div>
            </div>
            <div
              class="w-1/3 px-3"
              v-if="repeat_kaaz.repeat_policy == 'yearly' || repeat_kaaz.repeat_policy == 'monthly'"
            >
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-state"
              >End Day</label>
              <div class="relative">
                <select
                  v-model="repeat_kaaz.end_day"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="day in days" v-text="day"></option>
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
                  v-model="repeat_kaaz.end_time"
                  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="grid-state"
                >
                  <option v-for="time in end_times" v-text="time"></option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex">
            <div class="w-3 mt-3">
              <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
              >Save</button>
            </div>
          </div>
        </div>
        <div class="w-2/3 pl-2">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-state"
          >All Repeat Tasks</label>
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="border text-left px-4 py-2 w-2/4">Name</th>
                <th class="border text-left px-4 py-2 w-2/4">Repeat Policy</th>
                <th class="border text-left px-4 py-2 w-1/4">Start Time</th>
                <th class="border text-left px-4 py-2 w-1/4">End Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border px-4 py-2">Fazar</td>
                <td class="border px-4 py-2">Daily</td>
                <td class="border px-4 py-2">4:00 AM</td>
                <td class="border px-4 py-2">4:30 AM</td>
              </tr>
              <tr class="bg-gray-100">
                <td class="border px-4 py-2">Johor</td>
                <td class="border px-4 py-2">Weekend</td>
                <td class="border px-4 py-2">1:00 PM</td>
                <td class="border px-4 py-2">2:00 PM</td>
              </tr>
              <tr>
                <td class="border px-4 py-2">Asor</td>
                <td class="border px-4 py-2">Weekday</td>
                <td class="border px-4 py-2">4:00 PM</td>
                <td class="border px-4 py-2">5:00 PM</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import moment from "moment";

export default {
  mounted() {
    this.populateDays(moment().daysInMonth());
    this.populateTimes();
    this.getPossibleCurrentTime();
  },
  data: function() {
    return {
      repeat_kaaz: {
        name: "",
        tags: "",
        type: "",
        repeat_policy: "daily",
        start_month: moment().format("MMMM"),
        start_day: moment().format("D"),
        start_time: moment().format("hh:mm A"),
        end_month: moment().format("MMMM"),
        end_day: moment().format("D"),
        end_time: ""
      },
      months: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ],
      days: [],
      start_times: [],
      end_times: [],
      token: "",
      message: ""
    };
  },
  methods: {
    /**
     * Generate days list of specific month using moment
     *
     * @param {int} month
     * @return {void}
     */
    generateDaysOfMonth(month) {
      this.populateDays(moment(month, "MMMM").daysInMonth());
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
    getPossibleCurrentTime() {
      var minute = parseInt(moment().format("mm"));
      var hour = parseInt(moment().format("hh"));
      var amPm = moment().format("a");

      if (minute > 0 && minute < 15) minute = 15;
      if (minute > 15 && minute < 30) minute = 30;
      if (minute > 30 && minute < 45) minute = 45;
      if (minute > 45) {
        if (hour == 11) {
          amPm = amPm == "am" ? "pm" : "am";
        }
        hour += 1;
        minute = 0;
      }
      this.repeat_kaaz.start_time =
        this.pad(hour) + ":" + this.pad(minute) + amPm;

      minute += 15;
      if (minute > 0 && minute < 15) minute = 15;
      if (minute > 15 && minute < 30) minute = 30;
      if (minute > 30 && minute < 45) minute = 45;
      if (minute > 45) {
        if (hour == 11) {
          amPm = amPm == "am" ? "pm" : "am";
        }
        hour += 1;
      }
      this.repeat_kaaz.end_time =
        this.pad(hour) + ":" + this.pad(minute) + amPm;

      console.log("Start Time: " + this.repeat_kaaz.start_time);
      console.log("End Time: " + this.repeat_kaaz.end_time);
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
    onPolicyChange(event) {}
  }
};
</script>
