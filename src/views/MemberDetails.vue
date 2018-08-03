<template>
  <div class="m-details">
    <mt-header title="员工详情">
      <router-link to="/member" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    <div class="m-main">
      <div class="m-part">
        <mt-field label="员工姓名" type="text" v-model="memberinfo.user_currenname" readonly disableClear></mt-field>
        <mt-field label="登录账号" type="text" v-model="memberinfo.user_name" readonly disableClear></mt-field>
        <mt-field label="员工性别" type="text" value="女" v-if="memberinfo.user_sex === '1'" readonly disableClear></mt-field>
        <mt-field label="员工性别" type="text" value="男" v-if="memberinfo.user_sex === '0'" readonly disableClear></mt-field>
      </div>
      <div class="m-part">
        <mt-field label="所属店铺" type="text" v-model="memberinfo.user_store_name" readonly disableClear></mt-field>
        <mt-field label="所属部门" type="text" v-model="memberinfo.dept_name" readonly disableClear></mt-field>
      </div>
    </div>
    <div class="m-bottom">
      <mt-button type="default" size="small" @click="edit">修改信息</mt-button>
      <mt-button type="default" size="small" @click="del">删除员工</mt-button>
    </div>
  </div>
</template>

<script>
export default {
  name: "member-details",
  data() {
    return {
      memberinfo: {}
    };
  },
  methods: {
    getinfo(id) {
      this.$http
        .get(this.$store.state.SERVER + "/data/memberdetails.php?user_id=" + id)
        .then(
          function(res) {
            if (res.data) {
              this.memberinfo = res.data;
            }
          }.bind(this)
        );
    },
    del() {
      this.$messagebox
        .confirm("确定删除员工：" + this.memberinfo.user_currenname + "?")
        .then(() => {
          this.$http
            .post(
              this.$store.state.SERVER + "/data/memberdetails.php",
              this.$Qs.stringify({
                user_id: this.memberinfo.user_id
              })
            )
            .then(
              function(res) {
                if (res.data.result) {
                  this.$toast({
                    message: "删除成功！",
                    iconClass: "iconfont icon-icon31"
                  });
                  this.$router.replace({ path: "/member" });
                } else {
                  this.$toast({
                    message: "删除失败！",
                    iconClass: "iconfont icon-cuowu"
                  });
                }
              }.bind(this)
            );
        });
    },
    edit() {
      this.$store.commit("updateMemberinfo", this.memberinfo);
      this.$router.push({ path: "/editmember" });
    }
  },
  created() {
    let user_id = this.$route.params.id;
    this.getinfo(user_id);
  }
};
</script>

<style lang="less">
.m-details {
  .mint-header {
    background-color: #df5420;
  }
  .m-main {
    margin-top: 10px;
    .m-part {
      margin-bottom: 15px;
      .mint-field {
        .mint-field-core {
          position: absolute;
          padding-left: 40%;
        }
      }
    }
  }
  .m-bottom {
    position: fixed;
    bottom: 0;
    border-top: 1px solid #aaa;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    padding: 10px 0;
    background-color: #fff;
    .mint-button {
      background-color: #df5420;
      color: #fff;
    }
  }
}
</style>
