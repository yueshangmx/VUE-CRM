import Vue from "vue/types/index";

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