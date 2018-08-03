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
            <div class="b-name">{{kehuinfo.kehu_name}}</div>
            <span class="b-v" v-if="kehuinfo.kehu_vip_id === '1'">普通会员</span>
            <span class="b-v" v-if="kehuinfo.kehu_vip_id === '2'">VIP会员</span>
            <span>  | </span>
            <span class="b-n">卡号:{{kehuinfo.kehu_number}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="c-main">
      <div class="c-part">
        <mt-field label="手机号码" type="tel" :value="kehuinfo.kehu_phone" readonly disableClear></mt-field>
        <mt-field label="QQ" type="number" :value="kehuinfo.kehu_qq" readonly disableClear></mt-field>
        <mt-field label="微信" type="text" :value="kehuinfo.kehu_weixin" readonly disableClear></mt-field>
        <mt-field label="邮箱" type="email" :value="kehuinfo.kehu_email" readonly disableClear></mt-field>
      </div>
      <div class="c-part">
        <mt-field label="生日" type="text" :value="kehuinfo.kehu_birthday" readonly disableClear></mt-field>
        <mt-field label="固话" type="tel" :value="kehuinfo.kehu_guhua" readonly disableClear></mt-field>
        <mt-field label="地址" type="text" :value="kehuinfo.kehu_address" readonly disableClear></mt-field>
        <mt-field label="创建时间" type="text" :value="kehuinfo.kehu_created_time | time" readonly disableClear></mt-field>
        <mt-field label="备注" type="textarea" :attr="{style:'width:260;overflow-x:visible;overflow-y:visible;'}" :value="kehuinfo.kehu_beizhu" readonly disableClear></mt-field>
      </div>
    </div>
    <div class="c-bottom">
      <mt-button type="default" size="large" @click="del">删除客户</mt-button>
    </div>
  </div>
</template>

<script>
export default {
  name: "consumer-details",
  data() {
    return {
      kehuinfo: []
    };
  },
  filters: {
    time(value) {
      return new Date(value * 1000).toLocaleDateString();
    }
  },
  methods: {
    del() {
      let that = this;
      that.$messagebox
        .confirm("确定删除客户：" + that.kehuinfo.kehu_name)
        .then(function() {
          that.$http
            .post(
              that.$store.state.SERVER + "/data/consumerdetails.php",
              that.$Qs.stringify({
                state: 1,
                id: that.$route.params.id
              })
            )
            .then(function(res) {
              if (res.data.result) {
                that.$toast({
                  message: "成功！",
                  iconClass: "iconfont icon-icon31"
                });
                that.$router.replace({ path: "/consumer" });
              } else {
                that.$toast({
                  message: "失败！",
                  iconClass: "iconfont icon-cuowu"
                });
              }
            });
        });
    }
  },
  created() {
    this.$http
      .post(
        this.$store.state.SERVER + "/data/consumerdetails.php",
        this.$Qs.stringify({
          state: 0,
          id: this.$route.params.id
        })
      )
      .then(
        function(res) {
          this.kehuinfo = res.data;
        }.bind(this)
      );
  }
};
</script>

<style lang="less">
.c-details {
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
          height: 40px;
          width: 40px;
          border-radius: 5px;
          font-size: 1.5rem;
          line-height: 40px;
          margin-right: 10px;
        }
        .n-v-n {
          font-size: 12px;
          text-align: left;
          .b-name {
            font-size: 16px;
            padding-bottom: 2px;
          }
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
  .c-bottom {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #fff;
    .mint-button {
      background-color: #df5420;
      color: #fff;
    }
  }
}
</style>
