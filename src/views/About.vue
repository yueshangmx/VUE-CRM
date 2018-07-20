<template>
  <div class="about">
    <h2>智能CRM管理系统</h2>
    <div class="content">
      <p>版本 v0.2</p>
      <p>合作联系电话：<a href="tel:0551-64275530" type="t">0551-64275530</a></p>
    </div>
    <Foot />
  </div>
</template>

<script>
import Foot from "@/components/Foot.vue";

export default {
  comments: {
    Foot
  }
};
</script>

<style>
.about-active {
  background-color: #df5420 !important;
}
</style>
