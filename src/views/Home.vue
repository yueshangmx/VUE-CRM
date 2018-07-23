<template>
  <div class="home">
    <Head />
    <Main />
    <Foot />
  </div>
</template>

<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";
import Head from "@/components/Head.vue";
import Foot from "@/components/Foot";

export default {
  name: "home",
  components: {
    Foot,
    Head,
    Main
  }
};
</script>

<style lang="less">
.home {
  .nav-top {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    border-bottom: solid 1px #e6e6e6;
    .mint-header {
      width: 100%;
      background-color: #df5420;
    }
  }
  .nav-home {
    color: #df5420 !important;
    font-weight: bold;
  }
}
</style>
