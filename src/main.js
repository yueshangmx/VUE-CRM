import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
import Qs from "qs";
import MintUI from "mint-ui";
import "./assets/css/iconfont/iconfont.css";
import "mint-ui/lib/style.min.css";

Vue.use(MintUI);
Vue.prototype.$Qs = Qs;
Vue.prototype.$http = axios;
Vue.prototype.$Global = {
  //设置Cookie
  setCookie: function(name, value, day) {
    let date = new Date();
    date.setDate(date.getDate() + day);
    document.cookie = name + "=" + value + ";expires=" + date;
  },
  //获取cookie
  getCookie: function(name) {
    let reg = RegExp(name + "=([^;]+)");
    let arr = document.cookie.match(reg);
    if (arr) {
      return arr[1];
    } else {
      return "";
    }
  },
  //删除cookie
  delCookie: function(name) {
    this.setCookie(name, null, -1);
  }
};

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
  mounted() {
    if (!(sessionStorage.getItem("login") == "true")) {
      this.$router.replace({ path: "/login" });
    }
  }
}).$mount("#app");

router.beforeEach((to, from, next) => {
  if (to.path == "/login") {
    next();
  } else {
    if (sessionStorage.getItem("login") == "true") {
      next();
    } else {
      next({ path: "/login" });
    }
  }
});
