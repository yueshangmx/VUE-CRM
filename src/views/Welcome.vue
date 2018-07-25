<template>
  <div class="welcome">
    <h2 class="content">
      <i class="iconfont icon-icon-test"></i>
      <p>欢迎使用CRM管理系统</p>
    </h2>
    <div class="bg"></div>
  </div>
</template>

<script>
export default {
  name: "Welcome",
  created() {
    let that = this;
    let _token = this.$Global.getCookie("token");
    if (_token) {
      this.$http
        .post(
          this.$store.state.SERVER + "/data/login.php",
          this.$Qs.stringify({ token: _token })
        )
        .then(
          function(res) {
            if (res.data.user_token) {
              this.$store.commit("LOGIN", res.data);
              setTimeout(function() {
                that.$router.replace({ path: "/home" });
              }, 3000);
            }
          }.bind(this)
        );
    } else {
      setTimeout(function() {
        that.$router.replace({ path: "/login" });
      }, 3000);
    }
  }
};
</script>

<style lang="less">
.welcome {
  .content {
    z-index: 99;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 30%;
    i {
      font-size: 8rem;
      color: #fff;
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
</style>
