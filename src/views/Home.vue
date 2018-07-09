<template>
  <div class="home">
    <nav class="nav-top">
      <el-menu :default-active="activeIndex" class="el-menu" mode="horizontal" >
        <el-menu-item index="1">用户头像</el-menu-item>
        <el-submenu index="2">
          <template slot="title">登录账户：admin</template>
          <el-menu-item index="2-1">个人中心</el-menu-item>
          <el-menu-item index="2-2">修改密码</el-menu-item>
          <el-menu-item index="2-3">退出登录</el-menu-item>
        </el-submenu>
        <el-menu-item index="3">二维码</el-menu-item>
      </el-menu>
      <div class="line"></div>
    </nav>
    <Main />
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
  img {
    max-width: 100%;
  }
  .home-active {
    background-color: #409eff !important;
  }
}
</style>
