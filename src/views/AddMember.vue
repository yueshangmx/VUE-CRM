<template>
  <div class="add-member">
    <div class="am-top">
      <mt-header title="添加员工">
        <router-link to="/member" slot="left">
          <mt-button icon="back"></mt-button>
        </router-link>
      </mt-header>
    </div>
    <div class="am-main">
      <div class="am-part">
        <mt-field type="text" label="员工姓名" placeholder="必填" v-model="member.currenname" :state="checkmember.cname"></mt-field>
        <mt-field type="text" label="登录账号" placeholder="必填" v-model="member.username" :state="checkmember.uname"></mt-field>
        <mt-field type="password" label="登录密码" placeholder="必填" v-model="member.password" :state="checkmember.pwd"></mt-field>
        <mt-field label="性别"  :attr="{style:'display:none'}">
          <select name="sex" class="sex" v-model="member.sex">
            <option value="0">男士</option>
            <option value="1">女士</option>
          </select>
        </mt-field>
      </div>
      <div class="am-part">
        <mt-field label="所属部门" :attr="{style:'display:none'}">
          <select name="dept" class="am-dept" v-model="member.dept">
            <option v-for="item in deptlist" :key="item.dept_id" :value="item.dept_id">{{item.dept_name}}</option>
          </select>
        </mt-field>
        <mt-field label="员工权限" :attr="{style:'display:none'}">
          <select name="group" class="am-group" v-model="member.group">
            <option value="2">管理员</option>
            <option value="3">店长</option>
            <option value="4">员工</option>
          </select>
        </mt-field>
      </div>
      <div class="am-part am-save">
        <mt-button type="default" size="large" @click="saveMember">保存</mt-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "addMember",
  data() {
    return {
      deptlist: [],
      member: {
        currenname: "",
        username: "",
        password: "",
        sex: "0",
        dept: "",
        group: "4",
        parent_id: ""
      },
      checkmember: {
        cname: "",
        uname: "",
        pwd: ""
      }
    };
  },
  watch: {
    "member.currenname": function() {
      if (!this.member.currenname) {
        this.checkmember.cname = "";
      } else {
        let reg = /^[\u4e00-\u9fa5]{2,5}$/;
        this.checkmember.cname = reg.test(this.member.currenname)
          ? "success"
          : "warning";
      }
    },
    "member.username": function() {
      if (!this.member.username) {
        this.checkmember.uname = "";
      } else {
        let reg = /^[\w]{3,10}$/;
        this.checkmember.uname = reg.test(this.member.username)
          ? "success"
          : "warning";
      }
    },
    "member.password": function() {
      if (!this.member.password) {
        this.checkmember.pwd = "";
      } else {
        let reg = /^[\w\-\W]{6,16}$/;
        this.checkmember.pwd = reg.test(this.member.password)
          ? "success"
          : "warning";
      }
    }
  },
  created() {
    this.member.parent_id = JSON.parse(sessionStorage.getItem("info")).user_id;
    this.$http
      .get(
        this.$store.state.SERVER +
          "/data/add_member.php?user_id=" +
          this.member.parent_id
      )
      .then(
        function(res) {
          if (res) {
            this.deptlist = res.data;
            this.member.dept = res.data[0].dept_id;
          } else {
            this.$toast("服务器通信出错！");
          }
        }.bind(this)
      );
  },
  methods: {
    saveMember() {
      if (
        this.member.username &&
        this.member.currenname &&
        this.member.password
      ) {
        if (
          this.checkmember.cname == "success" &&
          this.checkmember.uname == "success" &&
          this.checkmember.pwd == "success"
        ) {
          this.$http
            .post(
              this.$store.state.SERVER + "/data/add_member.php",
              this.$Qs.stringify(this.member)
            )
            .then(
              function(res) {
                if (res.data.result) {
                  this.$toast({
                    message: "添加成功！",
                    iconClass: "iconfont icon-icon31"
                  });
                  this.$router.go(0);
                } else {
                  this.$toast({
                    message: "添加失败！请重试...",
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
.add-member {
  .am-top {
    .mint-header {
      background-color: #df5420;
    }
  }
  .am-main {
    .am-part {
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
            .am-dept,
            .am-group {
              border: 0;
              height: 40px;
              background-color: #fff;
            }
          }
        }
      }
    }
    .am-save {
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
