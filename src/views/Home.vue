<template>
  <div class="home">
    <nav class="nav-top">
      <div class="user-img">
        <img src="../assets/images/home.png" alt="">
      </div>
      <el-menu class="el-menu" mode="horizontal" >
        <el-submenu index="1">
          <template slot="title">登录账户：admin</template>
          <el-menu-item index="1-1"><router-link to="/home">个人中心</router-link></el-menu-item>
          <el-menu-item index="1-2">修改密码</el-menu-item>
          <el-menu-item index="1-3">退出登录</el-menu-item>
        </el-submenu>
      </el-menu>
      <div class="qcode">
        <i class="iconfont icon-code"></i>
      </div>
    </nav>
    <Main />
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
  components: {
    Main
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
    padding: 0 20px;
    border-bottom: solid 1px #e6e6e6;
    .user-img {
      img {
        height: 45px;
      }
    }
    ul {
      border-bottom: 0;
    }
    .qcode {
      .iconfont {
        font-size: 30px;
      }
    }
  }
  img {
    max-width: 100%;
  }
  .home-active {
    background-color: #409eff !important;
  }
}
</style>
