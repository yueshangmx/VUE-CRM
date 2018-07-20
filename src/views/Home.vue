<template>
  <div class="home" @click="closeMenu">
    <Head />
    <Main v-if="MainMenu" />
    <router-view></router-view>
    <Foot />
  </div>
</template>

<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";
import Foot from "@/components/Foot.vue";
import Head from "../components/Head";

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
    Head,
    Main,
    Foot
  },
  methods: {
    showMenu: function() {
      this.isshow = this.isshow ? false : true;
    },
    logout: function() {
      this.$Global.delCookie("token");
      sessionStorage.removeItem("info");
      this.$router.replace({ path: "/login" });
    },
    closeMenu: function() {
      this.isshow && (this.isshow = false);
      this.MainMenu && (this.MainMenu = false);
    },
    showMainMenu: function() {
      this.MainMenu = this.MainMenu ? false : true;
    }
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
      .menu {
        list-style: none;
        position: fixed;
        right: 0;
        background-color: #fff;
        width: 80px;
        padding-left: 0;
        li {
          padding-bottom: 5px;
          a {
            color: #df5420;
          }
          &:before {
            content: "> ";
            color: #df5420;
          }
        }
      }
    }
    ul {
      border-bottom: 0;
    }
  }
  .main {
    position: fixed;
    width: 100%;
    background-color: #f2f2f2;
  }
  img {
    max-width: 100%;
  }
  .home-active {
    background-color: #df5420 !important;
  }
}
</style>
