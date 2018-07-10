import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import "./assets/css/iconfont/iconfont.css";

Vue.use(ElementUI);
Vue.prototype.$http = axios;
Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");

router.beforeEach((to, from, next) => {
  let info = window.localStorage.getItem("info");
  if (!info && to.path != "/login") {
    next({ path: "/login" });
  } else {
    next();
  }
  if (to.path == "/home") {
    next({ path: "/home/usercenter" });
  }
});
