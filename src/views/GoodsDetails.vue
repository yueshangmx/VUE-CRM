<template>
  <div class="goods-details" v-if="piclist.length>0">
    <div class="gd-top">
      <mt-header title="商品详情">
        <router-link to="/goods" slot="left">
          <mt-button icon="back"></mt-button>
        </router-link>
      </mt-header>
    </div>
    <div class="gd-main">
      <ul class="piclist">
        <li v-for="(item,index) in piclist" :key="index">
          <img :src="item.src" alt="" :data-index="index" @click="pop(index)">
        </li>
      </ul>
      <div class="gd-name">
        <div class="goods-name">{{goodsinfo.goods_name}}</div>
        <div class="f-price">
          <div class="fenlei">{{goodsinfo.fenlei_name}}</div>
          <div class="price">{{goodsinfo.goods_price}}</div>
        </div>
      </div>
      <div class="info">
        <div class="sign infolist">
          <span>编号</span>
          {{goodsinfo.goods_sign}}
        </div>
        <div class="jinjia infolist">
          <span>进价</span>
          {{goodsinfo.goods_jinjia}}
        </div>
        <div class="inventory infolist">
          <span>库存</span>
          {{goodsinfo.goods_inventory}}
        </div>
        <div class="time infolist">
          <span>入库时间</span>
          {{goodsinfo.goods_sign | time}}
        </div>
        <div class="beizhu infolist">
          <span>备注</span>
          {{goodsinfo.goods_beizhu}}
        </div>
      </div>
    </div>
    <mt-popup
      v-model="popupVisible[index]"
      popup-transition="popup-fade" v-for="(item,index) in piclist" :key="index">
      <img :src="item.src" alt="">
    </mt-popup>
    <div class="gd-footer">
      <mt-button type="default" size="small" @click="edit">编辑商品</mt-button>
      <mt-button type="default" size="small" @click="del">删除商品</mt-button>
    </div>
  </div>
</template>

<script>
export default {
  name: "GoodsDetails",
  data() {
    return {
      goodsinfo: {},
      piclist: [],
      popupVisible: []
    };
  },
  filters: {
    time(value) {
      return new Date(value * 1000).toLocaleDateString();
    }
  },
  computed: {
    goods_id: function() {
      return this.$route.params.id;
    }
  },
  methods: {
    pop(index) {
      this.popupVisible.splice(index, 1, true);
    },
    edit() {
      console.log(this.goodsinfo);
      this.$store.commit("updateGoodsinfo", this.goodsinfo);
    },
    del() {
      this.$http
        .post(
          this.$store.state.SERVER + "/data/goodsdetails.php",
          this.$Qs.stringify({ goods_id: this.goodsinfo.goods_id })
        )
        .then(
          function(res) {
            if (res.data.result) {
              this.$toast({
                message: "成功删除！",
                iconClass: "iconfont icon-icon31"
              });
              this.$router.replace({ path: "/goods" });
            } else {
              this.$toast({
                message: "删除失败！",
                iconClass: "iconfont icon-cuowu"
              });
            }
          }.bind(this)
        );
    },
    getgoodsinfo() {
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/goodsdetails.php?goods_id=" +
            this.goods_id
        )
        .then(
          function(res) {
            if (res.data) {
              this.goodsinfo = res.data;
              this.piclist = JSON.parse(res.data.goods_litpic);
            } else {
              this.$toast({
                message: "获取商品详情失败！",
                iconClass: "iconfont icon-cuowu"
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
    this.getgoodsinfo();
  }
};
</script>

<style lang="less">
.goods-details {
  .gd-top {
    .mint-header {
      background-color: #df5420;
    }
  }
  .gd-main {
    .piclist {
      list-style: none;
      height: 60px;
      margin: 0;
      padding: 10px;
      border-bottom: 1px solid #ccc;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      li {
        width: 20%;
        img {
          height: 60px;
        }
      }
    }
    .gd-name {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      > div {
        padding: 8px 0;
      }
      .f-price {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: #555;
        .price {
          color: #f00;
          &:before {
            content: "¥：";
          }
        }
      }
    }
    .info {
      border-top: 1px solid #ccc;
      padding: 10px;
      background-color: #fff;
      .infolist {
        color: #555;
        font-size: 14px;
        padding: 8px 0;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        span {
          color: #333;
        }
      }
    }
  }
  .gd-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 10px 0;
    border-top: 1px solid #ccc;
    background-color: #fff;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    .mint-button {
      background-color: #df5430;
      color: #fff;
    }
  }
  .mint-popup {
    width: 100%;
    img {
      width: 90%;
    }
  }
}
</style>
