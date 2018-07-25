<template>
  <div class="login">
    <h1>登录CRM</h1>
    <div class="container">
      <mt-field label="用户名" placeholder="请输入用户名" :state="userinfo.nameState" v-model="userinfo.name"></mt-field>
      <mt-field label="密码" placeholder="请输入密码" type="password" :state="userinfo.pwdState" v-model="userinfo.pwd"></mt-field>
      <div class="clear"></div>
      <mt-button type="default" size="large" @click="login">登录</mt-button>
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
        token: ""
      }
    };
  },
  methods: {
    login() {
      if (this.userinfo.name && this.userinfo.pwd) {
        let that = this;
        if (
          this.userinfo.nameState == "success" &&
          this.userinfo.pwdState == "success"
        ) {
          this.$indicator.open({
            text: "登陆中...",
            spinnerType: "fading-circle"
          });
          this.$http
            .post(
              this.$store.state.SERVER + "/data/login.php",
              this.$Qs.stringify(this.userinfo)
            )
            .then(
              function(res) {
                if (res.data.user_token) {
                  this.$indicator.close();
                  this.$toast("登录成功！");
                  this.$Global.setCookie("token", res.data.user_token, 0.5);
                  this.$store.commit("LOGIN", res.data);
                  this.$router.replace({ path: "/home" });
                } else {
                  this.$indicator.close();
                  this.$toast("用户名或密码错误! ");
                }
              }.bind(this)
            )
            .catch(function(err) {
              that.$indicator.close();
              that.$toast("网络错误! ");
              console.log(err);
            });
        } else {
          this.$toast("用户名或密码不规范！");
        }
      } else {
        this.$toast("用户名或密码未填写！");
      }
    }
  },
  watch: {
    "userinfo.name": function() {
      if (this.userinfo.name) {
        let regName = /[A-Za-z_\-\u4e00-\u9fa5][A-Za-z0-9_\-\u4e00-\u9fa5]{5,15}/;
        this.userinfo.nameState = regName.test(this.userinfo.name)
          ? "success"
          : "waring";
      } else {
        this.userinfo.nameState = "";
      }
    },
    "userinfo.pwd": function() {
      if (this.userinfo.pwd) {
        let regPwd = /\w{6,16}/;
        this.userinfo.pwdState = regPwd.test(this.userinfo.pwd)
          ? "success"
          : "warning";
      } else {
        this.userinfo.pwdState = "";
      }
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
    .clear {
      height: 20px;
    }
    .mint-button {
      background-color: #df5420;
      color: #fff;
    }
  }
}
</style>
