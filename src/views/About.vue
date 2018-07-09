<template>
  <div class="about">
    <h1>This is an about page</h1>
    <div class="nav-bottom">
      <router-link to="/home">首页</router-link>
      <router-link to="/about" class="about-active">关于</router-link>
    </div>
  </div>
</template>

<style>
.about-active {
  background-color: #409eff !important;
}
</style>
