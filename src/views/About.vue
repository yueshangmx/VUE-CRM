<template>
  <div class="about">
    <Head />
    <h2>智能CRM管理系统</h2>
    <div class="content">
      <p>版本 v0.2</p>
      <p>合作联系电话：<a href="tel:0551-64275530" type="t">0551-64275530</a></p>
    </div>
    <Foot />
  </div>
</template>

<script>
import Head from "@/components/Head.vue";
import Foot from "../components/Foot";

export default {
  components: {
    Foot,
    Head
  }
};
</script>

<style lang="less">
.about {
  .nav-about {
    color: #df5420 !important;
  }
}
</style>
