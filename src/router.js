import Vue from "vue";
import Router from "vue-router";
import Welcome from "./views/Welcome.vue";
import Login from "./views/Login.vue";
import Home from "./views/Home.vue";
import Sales from "./views/Sales.vue";
import About from "./views/About.vue";
import Add from "./views/Add.vue";
import Consumer from "./views/Consumer";
import Goods from "./views/Goods";
import Member from "./views/Member";
import Cdetails from "./views/ConsumerDetails";
import Mdetails from "./views/MemberDetails";
import Addmember from "./views/AddMember";
import Editmember from "./views/EditMember";
import Group from "./views/Dept";
import Addgoods from "./views/AddGoods";
import Setfenlei from "./views/Setgoodsfenlei";
import Gdetails from "./views/GoodsDetails";

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
      component: Home
    },
    {
      path: "/login",
      name: "login",
      component: Login
    },
    {
      path: "/sales",
      name: "sales",
      component: Sales
    },
    {
      path: "/about",
      name: "about",
      component: About
    },
    {
      path: "/add",
      name: "add",
      component: Add
    },
    {
      path: "/consumer",
      name: "consumer",
      component: Consumer
    },
    {
      path: "/goods",
      name: "goods",
      component: Goods
    },
    {
      path: "/member",
      name: "member",
      component: Member
    },
    {
      path: "/addmember",
      name: "addmember",
      component: Addmember
    },
    {
      path: "/addgoods",
      name: "addgoods",
      component: Addgoods
    },
    {
      path: "/editmember",
      name: "editmember",
      component: Editmember
    },
    {
      path: "/group",
      name: "group",
      component: Group
    },
    {
      path: "/setfenlei",
      name: "setfenlei",
      component: Setfenlei
    },
    {
      path: "/consumer-details/:id",
      name: "consumer-details",
      component: Cdetails
    },
    {
      path: "/member-details/:id",
      name: "member-details",
      component: Mdetails
    },
    {
      path: "/goods-details/:id",
      name: "goods-details",
      component: Gdetails
    },
    {
      path: "*",
      component: Welcome
    }
  ]
});
