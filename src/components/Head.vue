<template>
  <div class="header">
    <mt-header :title="username">
      <!--<mt-button class="iconfont icon-shuaxin" slot="right"></mt-button>-->
    </mt-header>
  </div>
</template>

<script>
export default {
  name: "Head",
  data() {
    return {
      username: ""
    };
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    let userinfo = this.$store.state.userinfo;
    if (!userinfo || !userinfo.user_name) {
      this.$router.replace({ path: "/login" });
    } else {
      this.username = userinfo.user_store_name.toUpperCase();
    }
  }
};
</script>

<style lang="less" scoped>
.header {
  width: 100%;
  background-color: #fff;
  .mint-header {
    background-color: #df5420;
  }
}
</style>
