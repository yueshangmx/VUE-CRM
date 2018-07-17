<template>
  <div class="home" @click="closeMenu">
    <nav class="nav-top">
      <mt-header title="当前账户">
        <mt-button slot="left" @click.stop="showMainMenu">菜单</mt-button>
        <mt-button icon="more" slot="right" @click.stop="showMenu">
          <transition name="fade" mode="out-in">
            <ul class="menu" v-show="isshow">
              <li><router-link to="/home">个人中心</router-link></li>
              <li><router-link to="/home/pwd">修改密码</router-link></li>
              <li><a href="javascript:;" @click="logout">注销登录</a></li>
            </ul>
          </transition>
        </mt-button>
      </mt-header>
    </nav>
    <Main v-if="MainMenu" />
    <router-view></router-view>
    <div class="nav-bottom">
      <router-link to="/home" class="home-active">首页</router-link>
      <router-link to="/about">关于</router-link>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";

export default {
  name: "home",
  data() {
    return {
      isshow: false,
      MainMenu: false
    };
  },
  components: {
    Main
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
    let username = JSON.parse(window.sessionStorage.getItem("info"));
    if (!username || !username.user_name) {
      this.$router.replace({ path: "/login" });
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
            color: #409eff;
          }
          &:before {
            content: "> ";
            color: #409eff;
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
    background-color: #409eff !important;
  }
}
</style>
