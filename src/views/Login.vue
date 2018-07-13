<template>
  <div class="login">
    <h1>登录CRM</h1>
    <div class="container">
      <mt-field label="用户名" placeholder="请输入用户名" :state="userinfo.nameState" v-model="userinfo.name"></mt-field>
      <mt-field label="密码" placeholder="请输入密码" type="password" :state="userinfo.pwdState" v-model="userinfo.pwd"></mt-field>
      <mt-switch v-model="userinfo.checkbox">记住密码</mt-switch>
      <mt-button type="primary" size="large" @click="login">登录</mt-button>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      userinfo: {
        name: "",
        nameState: "",
        pwd: "",
        pwdState: "",
        id: "",
        checkbox: false,
        token: ""
      }
    };
  },
  methods: {
    login() {
      this.$indicator.open({
        text: "登陆中...",
        spinnerType: "fading-circle"
      });
      this.$http
        .post(
          "http://crm.dev.com/data/login.php",
          this.$Qs.stringify(this.userinfo)
        )
        .then(
          function(res) {
            if (res.data.user_name == this.userinfo.name) {
              console.log(res);
              this.$indicator.close();
              this.$toast("登录成功！");
              this.$router.replace("/home");
            } else {
              this.$indicator.close();
              this.$toast("登录失败！");
            }
          }.bind(this)
        )
        .catch(function(err) {
          console.log(err);
        });
    }
  }
};
</script>

<style lang="less">
.login {
  margin: 0 auto;
  padding-top: 40%;
  .container {
    padding: 0 20px;
    .mint-switch {
      margin: 10px auto;
    }
  }
}
</style>
