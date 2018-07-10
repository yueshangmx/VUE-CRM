<template>
  <div class="main">
    <ul>
      <li>
        <router-link to="/home/management"><i class="iconfont icon-kehuguanli"></i>客户管理</router-link>
      </li>
      <li>
        <router-link to="/home/create"><i class="iconfont icon-jiajianzujianjiahao"></i>创建客户</router-link>
      </li>
      <li>
        <router-link to="/home/packet"><i class="iconfont icon-xinyongqia"></i>卡包管理</router-link>
      </li>
      <li>
        <router-link to="/home/all-clients"><i class="iconfont icon-kehu"></i>所有客户</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Main"
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
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-around;
  box-sizing: border-box;
  li {
    width: 65px;
    height: 65px;
    padding: 5px;
    background-color: lightblue;
    border: 1px solid #eee;
    a {
      color: #409eff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      i {
        font-size: 30px;
      }
    }
  }
}
</style>
