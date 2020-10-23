<template>
  <div>
    <h1 class="font-normal text-3xl text-gray-700 leading-none">Repeat Kaaz</h1>

    <form
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

      <div class="w-full flex">
        <div class="w-full pl-2 mt-4">
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
              <tr v-for="rk in repeat_kaaz_list">
                <td class="border px-4 py-2">{{rk.name}}</td>
                <td class="border px-4 py-2">{{rk.repeat_policy}}</td>
                <td class="border px-4 py-2">{{rk.start_time}}</td>
                <td class="border px-4 py-2">{{rk.end_time}}</td>
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
import Form from "../core/Form.js";

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
  data: function () {
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
        if(this.kaaz_type_list.length > 0) {
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
          this.getList();
          this.new_repeat_kaaz_form();
        })
        .catch((errors) => console.log(errors));
    },
  },
};
</script>
