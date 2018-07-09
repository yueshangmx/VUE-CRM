<template>
  <div class="main">
    <ul>
      <li>
        <router-link to="/home/create">创建客户</router-link>
      </li>
      <li>
        <router-link to="/home/management">客户管理</router-link>
      </li>
      <li>
        <router-link to="/home/packet">卡包管理</router-link>
      </li>
      <li>
        <router-link to="/home/all-clients">所有客户</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Main",
  props: {
    msg: String
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
