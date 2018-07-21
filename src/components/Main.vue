<template>
  <div class="main">
    <div class="one">
      <router-link to="/add" class="link">
        <i class="iconfont icon-tianjiakehu"></i>
        创建客户
      </router-link>
      <router-link to="/consumer" class="link">
        <i class="iconfont icon-kehu"></i>
        客户管理
      </router-link>
      <router-link to="/goods" class="link">
        <i class="iconfont icon-shangpinguanli"></i>
        商品管理
      </router-link>
      <router-link to="/member" class="link">
        <i class="iconfont icon-yuangongguanli"></i>
        员工管理
      </router-link>
    </div>
    <div class="one more">
      <a href="javascript:;" class="link" @click="waiting">
        <i class="iconfont icon-jiahao"></i>
        更多
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Main",
  methods: {
    waiting() {
      this.$toast({
        message: "更多功能敬请期待！",
        duration: 1000
      });
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
.main {
  margin-left: 20px;
  margin-right: 20px;
  margin-top: 20px;
  .one {
    margin-bottom: 20px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    .link {
      width: 56px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #333;
      font-size: 14px;
      i {
        font-size: 24px;
        margin-bottom: 5px;
        font-weight: bold;
        color: #df5420;
      }
    }
  }
  .more {
    justify-content: flex-start;
  }
}
</style>
