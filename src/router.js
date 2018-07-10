import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";
import About from "./views/About.vue";
import Login from "./views/Login.vue";
import Welcome from "./views/Welcome.vue";
import Usercenter from "./components/Usercenter.vue";
import CC from "./components/chuanjiankehu.vue";
import CM from "./components/kehuguanli.vue";
import PM from "./components/kabaoguanli.vue";
import CL from "./components/suoyoukehu.vue";

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      name: "welcome",
      component: Welcome
    },
    {
      path: "/home",
      name: "home",
      component: Home,
      children: [
        {
          path: "usercenter",
          name: "usercenter",
          component: Usercenter
        },
        {
          path: "create",
          name: "create",
          component: CC
        },
        {
          path: "management",
          name: "management",
          component: CM
        },
        {
          path: "packet",
          name: "packet",
          component: PM
        },
        {
          path: "all-clients",
          name: "clist",
          component: CL
        }
      ]
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
    }
  ]
});
