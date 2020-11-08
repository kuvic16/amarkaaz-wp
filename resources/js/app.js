import Vue from "Vue";
import VueRouter from "vue-router";
import routes from "./routes";
import axios from "axios";
import App from "./App.vue";
import moment from "moment";
import ErrorAlert from "./components/alerts/Error";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.moment = moment;

Vue.use(VueRouter);
Vue.component("ErrorAlert", ErrorAlert);
// Vue.component("modal", Modal)
// Vue.component("form-modal", FormModal)

// make wordpress value as global
Vue.mixin({
  computed: {
    nonce: function() {
      return amarKaaz.nonce;
    },
    wp_url: function() {
      return amarKaaz.ajaxurl;
    },
  },
  methods: {},
});

let app = new Vue({
  el: "#app",
  router: new VueRouter(routes),
  render: (h) => h(App),
});
