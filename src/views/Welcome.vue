<template>
  <div class="welcome" @click="goLogin">
    <h2 class="content">
      <img class="logo" src="../assets/logo.png" alt="CRM">
      <p>欢迎使用CRM管理系统</p>
    </h2>
    <div class="bg"></div>
  </div>
</template>

<script>
export default {
  name: "Welcome",
  created() {},
  methods: {
    goLogin() {
      this.$router.push({ path: "/home" });
    }
  }
};
</script>

<style lang="less">
body {
  margin: 0;
  .welcome {
    .content {
      z-index: 99;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 30%;
      .logo {
        width: 30%;
      }
      p {
        color: #f2f2f2;
      }
    }
    .bg {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: -99;
      background: linear-gradient(#37ab2f, #336600);
    }
  }
}
</style>
