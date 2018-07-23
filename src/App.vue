<template>
  <div id="app">
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style lang="less">
body {
  background-color: #f2f2f2;
  #app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #333;
    box-sizing: border-box;
  }
  a {
    text-decoration: none;
  }
  .mint-field-state.is-success {
    color: #df5420;
  }
}
</style>
