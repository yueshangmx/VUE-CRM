<template>
  <div class="login">
    <h1>登录CRM</h1>
    <div class="container">
      <mt-field label="用户名" placeholder="请输入用户名" :state="userinfo.nameState" v-model="userinfo.name"></mt-field>
      <mt-field label="密码" placeholder="请输入密码" type="password" :state="userinfo.pwdState" v-model="userinfo.pwd"></mt-field>
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
        token: "498D8EBF84F656D7744B8FE65B840FBF"
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
            console.log(res);
            if (resData.result == true) {
              console.log(res);
              this.$indicator.close();
              this.$toast("登录成功！");
              console.log(this.$router);
              this.$router.push("/home");
            } else {
              console.log(res);
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
    button {
      margin-top: 20px;
    }
  }
}
</style>
