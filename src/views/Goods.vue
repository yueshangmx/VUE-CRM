<template>
  <div class="goods">
    <Top title="商品管理" />
    <h2>商品管理</h2>
    <router-link to="/addGoods" class="g-add" >
      <i class="iconfont icon-jiajianzujianjiahao"></i>
    </router-link>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "Goods",
  components: {
    Top
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
  }
};
</script>

<style scoped lang="less">
.goods {
  .g-add {
    i {
      position: fixed;
      right: 30px;
      bottom: 30px;
      background: #df5430;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      font-size: 1.5rem;
      color: #fff;
    }
  }
}
</style>
