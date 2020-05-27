import Vue from "Vue";
import VueRouter from "vue-router";
import routes from "./routes";
import axios from "axios";
import App from "./App.vue";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

Vue.use(VueRouter);

let app = new Vue({
  el: "#app",
  router: new VueRouter(routes),
  render: (h) => h(App),
});
