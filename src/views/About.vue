<template>
  <div class="about">
    <Head :title="this.$store.state.userinfo.user_currenname"/>
    <div class="a-top">
      <div class="a-name">{{store_name}}</div>
      <div class="a-info">
        <span v-if="member_total">{{"员工总数：" + member_total}}</span>
        <span>|</span>
        <span v-if="kehu_total">{{"客户总数：" + kehu_total}}</span>
      </div>
    </div>
    <h2>智能CRM管理系统</h2>
    <p>{{"当前版本："+this.$store.state.version}}</p>
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
    getTotal(value) {
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/about.php?state=" +
            value +
            "&parent_id=" +
            this.parent_id
        )
        .then(
          function(res) {
            if (res.data.result) {
              if (value === 0) {
                this.member_total = res.data.result;
              } else if (value === 1) {
                this.kehu_total = res.data.result;
              }
            } else {
              this.$toast({
                message: "部分数据获取失败！"
              });
            }
          }.bind(this)
        );
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.parent_id = this.$store.state.userinfo.user_parent_id;
    this.getTotal(0);
    this.getTotal(1);
  }
};
</script>

<style lang="less">
.about {
  .a-top {
    border-top: 1px solid #df7430;
    background-color: #df5420;
    color: #fff;
    font-size: 12px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    padding: 10px;
    .a-name {
      font-size: 14px;
      padding-bottom: 5px;
    }
    .a-info {
      span {
        padding-right: 6px;
      }
    }
  }
  .mint-button {
    color: #fff;
    background-color: #df5420;
  }
  .nav-about {
    color: #df5420 !important;
    font-weight: bold;
  }
}
</style>
