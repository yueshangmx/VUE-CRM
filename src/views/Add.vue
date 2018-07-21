<template>
  <div class="add" v-if="userinfo.kehu_number">
    <Top title="添加客户" />
    <div class="add-kehu">
      <div class="part">
        <mt-field label="客户编号" v-model="userinfo.kehu_number" readonly></mt-field>
        <mt-field label="客户姓名" placeholder="请输入用户名" v-model="userinfo.kehu_name"></mt-field>
        <mt-field label="手机号码" placeholder="请输入手机号" :attr="{maxLength:11}" type="tel" v-model="userinfo.kehu_phone"></mt-field>
        <mt-radio
          title="性别"
          v-model="userinfo.kehu_sex"
          :options="userinfo.options" @change="checksex">
        </mt-radio>
      </div>
      <div class="part">
        <mt-field label="地址" placeholder="请输入地址" type="text" v-model="userinfo.kehu_address"></mt-field>
        <mt-field label="邮箱" placeholder="请输入邮箱" type="email" v-model="userinfo.kehu_email"></mt-field>
        <mt-field label="生日" placeholder="请输入生日" type="date" v-model="userinfo.kehu_birthday"></mt-field>
      </div>
      <div class="part">
        <mt-field label="QQ" placeholder="客户QQ号" type="number" v-model="userinfo.kehu_qq"></mt-field>
        <mt-field label="微信" placeholder="客户微信号" type="text" v-model="userinfo.kehu_weixin"></mt-field>
        <mt-field label="手机" placeholder="客户其他手机号" type="tel" v-model="userinfo.kehu_phone2"></mt-field>
        <mt-field label="备注" placeholder="备注信息" type="textarea" rows="2" v-model="userinfo.kehu_beizhu"></mt-field>
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
      userinfo: {
        kehu_number: "",
        kehu_name: "",
        kehu_phone: "",
        kehu_sex: "",
        options: [
          {
            label: "男士",
            value: "0"
          },
          {
            label: "女士",
            value: "1"
          }
        ],
        kehu_birthday: "",
        kehu_address: "",
        kehu_beizhu: "",
        kehu_phone2: "",
        kehu_qq: "",
        kehu_weixin: "",
        kehu_email: ""
      }
    };
  },
  components: {
    Top
  },
  methods: {
    submit() {
      console.log(this.userinfo);
    },
    cancelsubmit() {
      this.$router.push({ path: "/home" });
    },
    checksex() {
      console.log(this.userinfo);
    }
  },
  created() {
    this.$http.get("http://vue.dev.com/data/add_kehu.php").then(
      function(res) {
        if (res.data.kehu_number) {
          this.userinfo.kehu_number = res.data.kehu_number;
        } else {
          this.$messagebox
            .confirm("获取服务器信息失败，是否重试？")
            .then(() => {
              console.log(this);
            });
        }
      }.bind(this)
    );
  }
};
</script>

<style lang="less">
.add {
  .add-kehu {
    margin-bottom: 65px;
    .part {
      margin-bottom: 10px;
      .mint-radiolist {
        text-align: left;
      }
      .mint-field {
        .mint-field-core {
          padding-right: 20px;
          text-align: right;
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
