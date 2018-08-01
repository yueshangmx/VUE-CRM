<template>
  <div class="edit-member">
    <div class="em-top">
      <mt-header title="添加员工">
        <router-link to="/member" slot="left">
          <mt-button icon="back"></mt-button>
        </router-link>
      </mt-header>
    </div>
    <div class="em-main">
      <div class="em-part">
        <mt-field type="text" label="登录账号" placeholder="必填" v-model="memberinfo.user_name" readOnly disableClear></mt-field>
        <mt-field type="text" label="员工姓名" placeholder="必填" v-model="memberinfo.user_currenname" :state="checkmember.cname"></mt-field>
        <mt-field label="员工性别"  :attr="{style:'display:none'}">
          <select name="sex" class="sex" v-model="memberinfo.user_sex">
            <option value="0">男士</option>
            <option value="1">女士</option>
          </select>
        </mt-field>
      </div>
      <div class="em-part">
        <mt-field label="所属部门" :attr="{style:'display:none'}">
          <select name="dept" class="em-dept" v-model="memberinfo.user_dept_id">
            <option v-for="item in deptlist" :key="item.dept_id" :value="item.dept_id">{{item.dept_name}}</option>
          </select>
        </mt-field>
        <mt-field label="员工权限" :attr="{style:'display:none'}">
          <select name="group" class="em-group" v-model="memberinfo.user_group_id">
            <option value="2">管理员</option>
            <option value="3">店长</option>
            <option value="4">员工</option>
          </select>
        </mt-field>
      </div>
      <div class="em-part em-save">
        <mt-button type="default" size="large" @click="updateMember">保存</mt-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "editmember",
  data() {
    return {
      deptlist: [],
      memberinfo: {},
      checkmember: {
        cname: ""
      }
    };
  },
  watch: {
    "memberinfo.user_currenname": function() {
      if (!this.memberinfo.user_currenname) {
        this.checkmember.cname = "";
      } else {
        let reg = /^[\u4e00-\u9fa5]{2,5}$/;
        this.checkmember.cname = reg.test(this.memberinfo.user_currenname)
          ? "success"
          : "warning";
      }
    }
  },
  created() {
    if (this.$store.state.memberinfo.user_id) {
      this.memberinfo = this.$store.state.memberinfo;
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/add_member.php?user_id=" +
            this.memberinfo.user_parent_id
        )
        .then(
          function(res) {
            if (res) {
              this.deptlist = res.data;
            } else {
              this.$toast("服务器通信出错！");
            }
          }.bind(this)
        );
    }
  },
  methods: {
    updateMember() {
      if (this.memberinfo.user_currenname) {
        if (this.checkmember.cname == "success") {
          this.$http
            .post(
              this.$store.state.SERVER + "/data/update_member.php",
              this.$Qs.stringify(this.memberinfo)
            )
            .then(
              function(res) {
                console.log(res);
                if (res.data.result) {
                  this.$toast({
                    message: "更新成功！",
                    iconClass: "iconfont icon-icon31"
                  });
                  this.$router.replace({ path: "/member" });
                } else {
                  this.$toast({
                    message: "更新失败！请重试...",
                    iconClass: "iconfont icon-cuowu"
                  });
                }
              }.bind(this)
            );
        } else {
          this.$toast({
            message: "姓名、账号或密码格式不正确！",
            iconClass: "iconfont icon-cuowu"
          });
        }
      } else {
        this.$toast({
          message: "必填项不能为空！",
          iconClass: "iconfont icon-cuowu"
        });
      }
    }
  }
};
</script>

<style lang="less">
.edit-member {
  .em-top {
    .mint-header {
      background-color: #df5420;
    }
  }
  .em-main {
    .em-part {
      margin-bottom: 15px;
      .mint-field {
        .mint-cell-wrapper {
          .mint-field-core {
            padding-left: 10%;
          }
          .mint-field-state {
            position: absolute;
            right: 10px;
          }
          .mint-field-other {
            padding-left: 10%;
            .sex,
            .em-dept,
            .em-group {
              border: 0;
              height: 40px;
              background-color: #fff;
            }
          }
        }
      }
    }
    .em-save {
      width: 90%;
      margin: 0 auto;
      button {
        background-color: #df5420;
        color: #f2f2f2;
      }
    }
  }
}
</style>
