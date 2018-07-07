<template>
  <div class="home">
    <img src="../assets/logo.png" alt="">
    <Main msg="Welcome to Your CRM"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";

export default {
  name: "home",
  components: {
    Main
  }
};
</script>

<style lang="less">
.home {
  img {
    max-width: 100%;
  }
}
</style>
