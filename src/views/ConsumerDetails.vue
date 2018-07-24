<template>
  <div class="c-details">
    <mt-header title="客户详情">
      <router-link to="/consumer" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    <div class="c-top">
      <div class="base">
        <div class="b-left">
          <i class="iconfont icon-kehuguanli"></i>
          <div class="n-v-n">
            <div class="b-name">{{userinfo.kehu_name}}</div>
            <span class="b-v" v-if="userinfo.kehu_vip_id == 1">普通会员</span>
            <span class="b-v" v-if="userinfo.kehu_vip_id == 2">VIP会员</span>
            |
            <span class="b-n">卡号:{{userinfo.kehu_number}}</span>
          </div>
        </div>
        <div class="b-right">
          <i class="iconfont icon-jiantouyou"></i>
        </div>
      </div>
    </div>
    <div class="c-main">
      <div class="c-part">
        <mt-field label="手机号码" type="tel" v-model="userinfo.kehu_phone" readonly disableClear></mt-field>
        <mt-field label="QQ" type="number" v-model="userinfo.kehu_qq" readonly disableClear></mt-field>
        <mt-field label="微信" type="text" v-model="userinfo.kehu_weixin" readonly disableClear></mt-field>
        <mt-field label="邮箱" type="email" v-model="userinfo.kehu_email" readonly disableClear></mt-field>
      </div>
      <div class="c-part">
        <mt-field label="生日" type="text" v-model="userinfo.kehu_birthday" readonly disableClear></mt-field>
        <mt-field label="固话" type="tel" v-model="userinfo.kehu_guhua" readonly disableClear></mt-field>
        <mt-field label="地址" type="text" v-model="userinfo.kehu_address" readonly disableClear></mt-field>
        <mt-field label="备注" type="textarea" :attr="{style:'width:260;overflow-x:visible;overflow-y:visible;'}" v-model="userinfo.kehu_beizhu" readonly disableClear></mt-field>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "consumer-details",
  data() {
    return {
      userinfo: []
    };
  },
  created() {
    let user_id = this.$route.params.id;
    this.$http
      .post(
        "http://vue.dev.com/data/consumerdetails.php",
        this.$Qs.stringify({ id: user_id })
      )
      .then(
        function(res) {
          console.log(res);
          this.userinfo = res.data;
        }.bind(this)
      );
  }
};
</script>

<style lang="less">
.details {
  .mint-header {
    background-color: #df5420;
  }
  .c-top {
    .base {
      padding: 5px 10px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      color: #f2f2f2;
      background: #df5435;
      .b-left {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        i {
          background: #aaa;
          height: 30px;
          width: 30px;
          border-radius: 5px;
          font-size: 1.5rem;
          line-height: 30px;
          margin-right: 10px;
        }
        .n-v-n {
          font-size: 12px;
          text-align: left;
          .b-name {
            font-size: 14px;
          }
        }
      }
      .b-right {
        i {
          font-size: 12px;
        }
      }
    }
  }
  .c-main {
    .c-part {
      margin-bottom: 15px;
      .mint-field {
        .mint-field-core {
          text-align: right;
          padding-right: 20px;
        }
      }
    }
  }
}
</style>
