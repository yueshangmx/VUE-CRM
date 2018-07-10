<template>
  <div class="home">
    <nav class="nav-top">
      <mt-header title="标题过长会隐藏后面的内容啊哈哈哈哈">
        <mt-button v-link="'/'" icon="back" slot="left">返回</mt-button>
        <mt-button icon="more" slot="right"></mt-button>
      </mt-header>
    </nav>
    <Main />
    <router-view></router-view>
    <div class="nav-bottom">
      <router-link to="/home" class="home-active">首页</router-link>
      <router-link to="/about">关于</router-link>
    </div>
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
  .nav-top {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    border-bottom: solid 1px #e6e6e6;
    .user-img {
      img {
        height: 45px;
      }
    }
    ul {
      border-bottom: 0;
    }
    .qcode {
      .iconfont {
        font-size: 30px;
      }
    }
  }
  img {
    max-width: 100%;
  }
  .home-active {
    background-color: #409eff !important;
  }
}
</style>
