<template>
  <div class="goodslist">
    <Top title="商品管理" />
    <div class="gl-main">
      <div class="gl-top">
        <div class="gl-t-left">商品总数</div>
        <router-link class="gl-t-right" to="/setfenlei">
          <i class="iconfont icon-shezhi"></i>
        </router-link>
      </div>
    </div>
    <router-link to="/addGoods" class="gl-add" >
      <i class="iconfont icon-jiajianzujianjiahao"></i>
    </router-link>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "goods",
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
.goodslist {
  .gl-main {
    .gl-top {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      margin: 0 10px;
      .gl-t-left {
        font-size: 12px;
      }
      .gl-t-right {
        margin: 4px 0;
        i {
          font-weight: bold;
          font-size: 18px;
          color: #333;
        }
      }
    }
  }
  .gl-add {
    i {
      position: fixed;
      right: 30px;
      bottom: 50px;
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
