<template>
  <div class="home" @click="closeMenu">
    <nav class="nav-top">
      <mt-header title="当前账户">
        <mt-button icon="more" slot="right" @click.stop="showMenu">
          <transition name="fade" mode="out-in">
            <ul class="menu" v-show="isshow">
              <li><router-link to="/home">个人中心</router-link></li>
              <li><router-link to="/pwd">修改密码</router-link></li>
              <li><a href="javascript:;" @click="logout">注销登录</a></li>
            </ul>
          </transition>
        </mt-button>
      </mt-header>
    </nav>
    <p>这是修改密码的界面</p>
    <div class="nav-bottom">
      <router-link to="/home" class="home-active">首页</router-link>
      <router-link to="/about">关于</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "passwd",
  data() {
    return {
      isshow: ""
    };
  },
  methods: {
    showMenu: function(e) {
      this.isshow = this.isshow ? false : true;
      let _e = e || event;
      _e.stopPropagation();
      _e.cancelBubble = true;
    },
    logout: function() {
      this.$Global.delCookie("token");
      this.$router.replace({ path: "/login" });
    },
    closeMenu: function() {
      console.log(this.isshow);
      this.isshow && (this.isshow = false);
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
  }
  ul {
    border-bottom: 0;
  }
  .home-active {
    background-color: #409eff !important;
  }
}
</style>
