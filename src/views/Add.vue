<template>
  <div class="add" v-if="kehuinfo.kehu_number">
    <Top title="添加客户" />
    <div class="add-kehu">
      <div class="part">
        <mt-field label="客户编号" v-model="kehuinfo.kehu_number" :state="checkinfo.number" readonly disableClear></mt-field>
        <mt-field label="客户姓名" placeholder="请输入用户名(必填)" v-model="kehuinfo.kehu_name" :state="checkinfo.name"></mt-field>
        <mt-field label="手机号码" placeholder="请输入手机号(必填)" :attr="{maxLength:11}" type="tel" v-model="kehuinfo.kehu_phone" :state="checkinfo.phone"></mt-field>
        <mt-field label="性别"  :attr="{style:'display:none'}">
          <select name="sex" class="sex" v-model="kehuinfo.kehu_sex">
            <option value="0">男士</option>
            <option value="1">女士</option>
          </select>
        </mt-field>
      </div>
      <div class="part">
        <mt-field label="生日" placeholder="请输入生日" type="date" v-model="kehuinfo.kehu_birthday" :state="checkinfo.birthday"></mt-field>
        <mt-field label="邮箱" placeholder="请输入邮箱" type="email" v-model="kehuinfo.kehu_email" :state="checkinfo.email"></mt-field>
        <mt-field label="地址" placeholder="请输入地址" type="text" v-model="kehuinfo.kehu_address" :state="checkinfo.address"></mt-field>
        <mt-field label="备注" placeholder="备注信息" type="textarea" rows="2" v-model="kehuinfo.kehu_beizhu" :state="checkinfo.beizhu"></mt-field>
      </div>
      <div class="part">
        <mt-field label="QQ" placeholder="QQ号" type="number" v-model="kehuinfo.kehu_qq" :state="checkinfo.qq"></mt-field>
        <mt-field label="微信" placeholder="微信号" type="text" v-model="kehuinfo.kehu_weixin" :state="checkinfo.weixin"></mt-field>
        <mt-field label="固话" placeholder="固话(区号-号码)" type="tel" v-model="kehuinfo.kehu_guhua" :state="checkinfo.guhua"></mt-field>
      </div>
    </div>
    <div class="submit">
      <mt-button type="default" size="small" @click="cancelsubmit">取消添加</mt-button>
      <mt-button type="default" size="small" @click="submit">保存继续</mt-button>
    </div>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "Add",
  data() {
    return {
      kehuinfo: {
        kehu_parent_id: "",
        kehu_number: "",
        kehu_name: "",
        kehu_phone: "",
        kehu_sex: "0",
        kehu_birthday: "",
        kehu_address: "",
        kehu_beizhu: "",
        kehu_guhua: "",
        kehu_qq: "",
        kehu_weixin: "",
        kehu_email: ""
      },
      checkinfo: {
        number: "success",
        name: "",
        phone: "",
        birthday: "",
        address: "",
        beizhu: "",
        qq: "",
        weixin: "",
        email: "",
        guhua: ""
      }
    };
  },
  components: {
    Top
  },
  methods: {
    submit() {
      if (this.kehuinfo.kehu_name && this.kehuinfo.kehu_phone) {
        if (
          this.checkinfo.name === "success" &&
          this.checkinfo.phone === "success"
        ) {
          this.$http
            .post(
              this.$store.state.SERVER + "/data/add_kehu.php",
              this.$Qs.stringify(this.kehuinfo)
            )
            .then(
              function(res) {
                if (res.data.result) {
                  this.$toast({
                    message: "添加成功！",
                    iconClass: "iconfont icon-icon31"
                  });
                  this.getNumber();
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
            message: "姓名或手机格式不正确！请检查后重试...",
            iconClass: "iconfont icon-cuowu"
          });
        }
      } else {
        this.$toast({
          message: "姓名和手机不能为空！",
          iconClass: "iconfont icon-cuowu"
        });
      }
    },
    cancelsubmit() {
      this.$router.push({ path: "/home" });
    },
    getNumber() {
      let that = this;
      Object.keys(that.kehuinfo).forEach(key => (that.kehuinfo[key] = ""));
      that.kehuinfo.kehu_parent_id = this.$store.state.userinfo.user_id;
      that.kehuinfo.kehu_sex = 0;
      that.$http
        .get(that.$store.state.SERVER + "/data/add_kehu.php")
        .then(function(res) {
          if (res.data.kehu_number) {
            that.kehuinfo.kehu_number = parseInt(res.data.kehu_number) + 1;
          } else {
            that.$messagebox
              .confirm("获取服务器信息失败，是否重试？")
              .then(() => {
                that.getNumber();
              });
          }
        });
    }
  },
  watch: {
    "kehuinfo.kehu_name": function() {
      if (!this.kehuinfo.kehu_name) {
        this.checkinfo.name = "";
      } else {
        let regName = /^[\u4e00-\u9fa5\w-]{2,50}$/;
        this.checkinfo.name = regName.test(this.kehuinfo.kehu_name)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_phone": function() {
      if (!this.kehuinfo.kehu_phone) {
        this.checkinfo.phone = "";
      } else {
        let regPhone = /^0?(13|14|15|16|17|18|19)[0-9]{9}$/;
        this.checkinfo.phone = regPhone.test(this.kehuinfo.kehu_phone)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_birthday": function() {
      if (!this.kehuinfo.kehu_birthday) {
        this.checkinfo.birthday = "";
      } else {
        let regBirth = /^\d{4}(\\-|\/|.)[0|1][\d]\1[0-3][\d]$/;
        this.checkinfo.birthday = regBirth.test(this.kehuinfo.kehu_birthday)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_email": function() {
      if (!this.kehuinfo.kehu_email) {
        this.checkinfo.email = "";
      } else {
        let regEmail = /^\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}$/;
        this.checkinfo.email = regEmail.test(this.kehuinfo.kehu_email)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_address": function() {
      if (!this.kehuinfo.kehu_address) {
        this.checkinfo.address = "";
      } else {
        let regAddr = /^[\u4e00-\u9fa5|\d]{5,60}$/;
        this.checkinfo.address = regAddr.test(this.kehuinfo.kehu_address)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_beizhu": function() {
      if (!this.kehuinfo.kehu_beizhu) {
        this.checkinfo.beizhu = "";
      } else {
        let regBeizhu = /^[\S]{0,250}$/;
        this.checkinfo.beizhu = regBeizhu.test(this.kehuinfo.kehu_beizhu)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_qq": function() {
      if (!this.kehuinfo.kehu_qq) {
        this.checkinfo.qq = "";
      } else {
        let regQQ = /[1-9]([0-9]{5,11})/;
        this.checkinfo.qq = regQQ.test(this.kehuinfo.kehu_qq)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_weixin": function() {
      if (!this.kehuinfo.kehu_weixin) {
        this.checkinfo.weixin = "";
      } else {
        let regWeixin = /^[a-zA-Z][\w\d-]{5,19}$/;
        this.checkinfo.weixin = regWeixin.test(this.kehuinfo.kehu_weixin)
          ? "success"
          : "warning";
      }
    },
    "kehuinfo.kehu_guhua": function() {
      if (!this.kehuinfo.kehu_guhua) {
        this.checkinfo.guhua = "";
      } else {
        let regGuhua = /^([0-9()-（） ]{3,7})?[\d]{7,8}$/;
        this.checkinfo.guhua = regGuhua.test(this.kehuinfo.kehu_guhua)
          ? "success"
          : "warning";
      }
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getNumber();
  }
};
</script>

<style lang="less">
.add {
  .add-kehu {
    margin-bottom: 62px;
    .part {
      margin-bottom: 10px;
      .mint-field {
        .mint-field-core {
          padding-left: 10%;
          background-color: #fff;
        }
        span.mint-field-state.is-success,
        span.mint-field-state.is-warning {
          right: 8px;
          position: absolute;
        }
        .mint-field-other {
          padding-left: 10%;
          .sex {
            border: 0;
            font-size: 16px;
            height: 40px;
            color: #333;
            background-color: #fff;
          }
        }
      }
    }
  }
  .submit {
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
