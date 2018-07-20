<template>
  <div class="home">
    <Head />
    <Main />
    <Foot />
  </div>
</template>

<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";
import Head from "@/components/Head.vue";
import Foot from "../components/Foot";

export default {
  name: "home",
  data() {
    return {
      isshow: false,
      MainMenu: false,
      username: ""
    };
  },
  components: {
    Foot,
    Head,
    Main
  },
  created() {
    let userinfo = JSON.parse(sessionStorage.getItem("info"));
    if (!userinfo || !userinfo.user_name) {
      this.$router.replace({ path: "/login" });
    } else {
      this.username = userinfo.user_name.toUpperCase();
    }
  }
};
</script>

<style lang="less">
.home {
  .nav-top {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    border-bottom: solid 1px #e6e6e6;
    .mint-header {
      width: 100%;
      background-color: #df5420;
    }
  }
  .nav-home {
    color: #df5420 !important;
  }
}
</style>
