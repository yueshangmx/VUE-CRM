<template>
  <div class="header">
    <mt-header :title="title">
      <!--<mt-button class="iconfont icon-shuaxin" slot="right"></mt-button>-->
    </mt-header>
  </div>
</template>

<script>
export default {
  name: "Head",
  props: ["title"],
  data() {
    return {
      username: ""
    };
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
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
