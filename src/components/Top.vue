<template>
  <div class="top">
    <mt-header>
      <router-link to="/home" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
  </div>
</template>

<script>
export default {
  name: "Top"
};
</script>

<style scoped lang="less">
.top {
  .mint-header {
    background-color: #df5420;
  }
}
</style>
