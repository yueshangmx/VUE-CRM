<template>
  <div class="about">
    <h2>智能CRM管理系统</h2>
    <div class="content">
      <p>版本 v0.2</p>
      <p>合作联系电话：<a href="tel:0551-64275530" type="t">0551-64275530</a></p>
    </div>
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
