import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    SERVER: "http://vue.dev.com",
    userinfo: {}
  },
  mutations: {
    updateUserInfo() {
      this.state.userinfo = JSON.parse(window.sessionStorage.getItem("info"));
    },
    LOGIN(state, data) {
      this.state.userinfo = data;
      sessionStorage.setItem("info", JSON.stringify(data));
    }
  },
  actions: {}
});
