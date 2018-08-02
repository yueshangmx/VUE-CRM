<template>
  <div class="goodslist">
    <Top title="商品管理" />
    <div class="gl-main">
      <div class="gl-top">
        <div class="gl-t-left">商品总数</div>
        <router-link class="gl-t-right" to="/setfenlei">
          <i class="iconfont icon-shezhi"></i>
        </router-link>
      </div>
      <mt-loadmore :top-method="loadTop" ref="loadmore">
        <ul class="list">
          <li v-for="(item,index) in list" :key="index">
            <router-link :to="'/goods-details/'+item.goods_id">
                <img :src="item.goods_litpic | decode" alt="">
                <div class="g-ns">
                  <div class="g-name">{{item.goods_name}}</div>
                  <div class="g-sign">{{"编码："+item.goods_sign}}</div>
                  <div class="g-ip">
                    <div class="g-inventory">{{"库存："+item.goods_inventory+" 台"}}</div>
                    <div class="g-price">{{item.goods_price}}</div>
                  </div>
                </div>
            </router-link>
          </li>
        </ul>
      </mt-loadmore>
    </div>
    <router-link to="/addGoods" class="gl-add" >
      <i class="iconfont icon-jiajianzujianjiahao"></i>
    </router-link>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "goods",
  data() {
    return {
      list: []
    };
  },
  components: {
    Top
  },
  filters: {
    decode(value) {
      return JSON.parse(value)[0].src;
    }
  },
  methods: {
    loadTop() {
      this.getgoods();
      this.$refs.loadmore.onTopLoaded();
    },
    getgoods() {
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/goodslist.php?parent_id=" +
            this.$store.state.userinfo.user_parent_id
        )
        .then(
          function(res) {
            if (res.data.length > 0) {
              this.list = res.data;
            } else {
              this.$toast({
                message: ""
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
    this.getgoods();
  }
};
</script>

<style scoped lang="less">
.goodslist {
  .gl-main {
    .gl-top {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      margin: 0 10px;
      .gl-t-left {
        font-size: 12px;
      }
      .gl-t-right {
        margin: 4px 0;
        i {
          font-weight: bold;
          font-size: 18px;
          color: #333;
        }
      }
    }
    .list {
      margin-top: 0;
      list-style: none;
      padding-left: 10px;
      background-color: #fff;
      li {
        padding: 5px 10px 2px 0;
        border-bottom: 1px solid #ccc;
        a {
          color: #999;
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: flex-start;
          height: 60px;
          img {
            box-sizing: border-box;
            border-radius: 5px;
            height: 50px;
            width: 50px;
            margin-right: 10px;
          }
          .g-ns {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            div {
              margin-bottom: 2px;
            }
            .g-name {
              color: #333;
            }
            .g-sign {
              font-size: 12px;
            }
            .g-ip {
              font-size: 12px;
              display: flex;
              flex-direction: row;
              align-items: center;
              justify-content: flex-start;
              .g-inventory {
                margin-right: 80px;
              }
              .g-price {
                color: #f00;
              }
            }
          }
        }
      }
    }
  }
  .gl-add {
    i {
      position: fixed;
      right: 30px;
      bottom: 50px;
      background: #df5430;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      font-size: 1.5rem;
      color: #fff;
    }
  }
}
</style>
