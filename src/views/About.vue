<template>
  <div class="about">
    <Head :title="this.$store.state.userinfo.user_currenname"/>
    <div class="a-top">
      <div class="a-name">{{store_name}}</div>
      <div class="a-info">
        <span>{{"员工总数：" + member_total}}</span>
        <span>|</span>
        <span>{{"客户总数：" + kehu_total}}</span>
      </div>
    </div>
    <h2>智能CRM管理系统</h2>

    <div class="content">
      <p>合作联系电话：<a href="tel:0551-64275530" type="tel">0551-64275530</a></p>
    </div>
    <mt-button type="default" @click="logout">退出登录</mt-button>
    <Foot />
  </div>
</template>

<script>
import Head from "@/components/Head.vue";
import Foot from "../components/Foot";

export default {
  name: "about",
  components: {
    Foot,
    Head
  },
  data() {
    return {
      member_total: "",
      kehu_total: "",
      parent_id: ""
    };
  },
  computed: {
    store_name: function() {
      return this.$store.state.userinfo.user_store_name;
    }
  },
  methods: {
    logout() {
      window.sessionStorage.removeItem("info");
      this.$Global.delCookie("token");
      this.$router.replace({ path: "/login" });
    },
    getMemberTotal() {
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/about.php?state=0&parent_id=" +
            this.parent_id
        )
        .then(
          function(res) {
            console.log(res);
          }.bind(this)
        );
    },
    getKehuTotal() {}
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getMemberTotal();
    this.getKehuTotal();
    this.parent_id = this.$store.state.userinfo.user_parent_id;
  }
};
</script>

<style lang="less">
.about {
  .nav-about {
    color: #df5420 !important;
    font-weight: bold;
  }
  .mint-button {
    color: #fff;
    background-color: #df5420;
  }
}
</style>
