<template>
  <div class="nav-bottom">
    <router-link to="/home" class="nav-home">
      <i class="iconfont icon-home"></i>
      首页
    </router-link>
    <router-link to="/sales" class="nav-sales">
      <i class="iconfont icon-iconfontzhizuobiaozhunbduan35"></i>
      销售查询
    </router-link>
    <router-link to="/about" class="nav-about">
      <i class="iconfont icon-wode"></i>
      我的
    </router-link>
  </div>
</template>

<script>
export default {
  name: "Foot"
};
</script>

<style scoped lang="less">
.nav-bottom {
  position: fixed;
  bottom: 0;
  border-top: 1px solid #aaa;
  width: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-around;
  a {
    height: 50px;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    i {
      font-size: 18px;
    }
  }
}
</style>
