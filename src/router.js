import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";
import About from "./views/About.vue";
import Login from "./views/Login.vue";
import Welcome from "./views/Welcome.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "welcome",
      component: Welcome
    },
    {
      path: "/home",
      name: "home",
      component: Home
    },
    {
      path: "/login",
      name: "login",
      component: Login
    },
    {
      path: "/about",
      name: "about",
      component: About
    },
    {
      path: "*",
      component: Welcome
    }
  ]
});
