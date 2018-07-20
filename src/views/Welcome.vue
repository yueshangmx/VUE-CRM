<template>
  <div class="welcome">
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
  created() {
    let _token = this.$Global.getCookie("token");
    if (_token) {
      this.$http
        .post(
          "http://crm.coolbear.wang/data/login.php",
          this.$Qs.stringify({ token: _token })
        )
        .then(
          function(res) {
            if (res.data.user_token) {
              sessionStorage.setItem("info", JSON.stringify(res.data));
              this.$router.replace({ path: "/home" });
            }
          }.bind(this)
        );
    } else {
      let that = this;
      setTimeout(function() {
        that.$router.replace({ path: "/login" });
      }, 3000);
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
      background: linear-gradient(#ffa500, #df5420);
    }
  }
}
</style>
