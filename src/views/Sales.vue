<template>
  <div class="sales">
    销售查询
    <Foot />
  </div>
</template>

<script>
import Foot from "../components/Foot";
export default {
  name: "Sales",
  components: {
    Foot
  }
};
</script>

<style lang="less">
.sales {
  .nav-sales {
    color: #df5420 !important;
    font-weight: bold;
  }
}
</style>
