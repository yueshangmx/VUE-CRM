<template>
  <div class="sales">
    <Top title="销售查询" />
    <div class="s-main">
      <div class="s-top">查询筛选</div>
      <div class="s-list">
        <div class="list-top">
          <span class="time">{{current_time}}</span>
          <span class="sales-money">{{"销售总额："+sales_money}}</span>
        </div>
        <mt-loadmore :top-method="loadTop" :bottom-method="loadBottom" :bottom-all-loaded="allLoaded" ref="loadmore" max-distance="90">
          <ul class="sales-list">
            <li v-for="(item,index) in list" :key="index">
              <router-link :to="'/salesdetails/'+item.id">
                <div class="item-left">
                  <div class="img">
                    <img :src="item.goods_litpic | imgurl" alt="">
                  </div>
                  <div class="info">
                    <div class="s-name">{{item.goods_name}}</div>
                    <div class="s-info">
                      <div>
                        <span>{{item.sales_time | time}}</span>
                        <span class="line">|</span>
                        <span>{{item.kehu_name}}</span>
                      </div>
                      <i>{{"x "+item.sales_number}}</i>
                    </div>
                  </div>
                </div>
                <div class="item-right">{{item.sales_price}}</div>
              </router-link>
            </li>
          </ul>
        </mt-loadmore>
      </div>
    </div>
    <Foot />
  </div>
</template>

<script>
import Foot from "../components/Foot";
import Top from "../components/Top";
export default {
  name: "Sales",
  components: {
    Top,
    Foot
  },
  data() {
    return {
      list: [],
      allLoaded: false
    };
  },
  computed: {
    current_time: function() {
      let now = new Date();
      // eslint-disable-next-line
      let mm = (now.getMonth()+1) < 10 ? "0"+(now.getMonth()+1) : now.getMonth()+1;
      let dd = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
      return now.getFullYear() + "-" + mm + "-" + dd;
    },
    sales_money: function() {
      let total = 0;
      for (let i = 0; i < this.list.length; i++) {
        total += parseFloat(this.list[i].sales_price);
      }
      return total;
    }
  },
  filters: {
    imgurl(value) {
      return JSON.parse(value)[0].src;
    },
    time(value) {
      let date = new Date(value * 1000);
      let h = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
      let m =
        date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
      return h + ":" + m;
    }
  },
  methods: {
    getSalesList() {
      this.$http
        .get(
          this.$store.state.SERVER +
            "/data/sales.php?parent_id=" +
            this.$store.state.userinfo.user_parent_id
        )
        .then(
          function(res) {
            this.list = res.data;
            if (res.data.length < 15) {
              this.allLoaded = true;
            }
          }.bind(this)
        );
    },
    loadTop() {
      this.getSalesList();
      this.$refs.loadmore.onTopLoaded();
    },
    loadBottom() {
      this.getSalesList();
      this.$refs.loadmore.onBottomLoaded();
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getSalesList();
  }
};
</script>

<style lang="less">
.sales {
  .s-main {
    .s-top {
      height: 50px;
      background-color: #df5420;
      border-top: 1px solid #df7430;
      color: #fff;
    }
    .s-list {
      .list-top {
        padding: 5px 10px;
        font-size: 12px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
      }
      .sales-list {
        padding-left: 10px;
        margin: 0;
        list-style: none;
        background-color: #fff;
        li {
          padding: 10px 10px 10px 0;
          border-bottom: 1px solid #ccc;
          a {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            color: #333;
            .item-left {
              display: flex;
              flex-direction: row;
              align-items: center;
              justify-content: center;
              .img {
                margin-right: 8px;
                height: 40px;
                img {
                  width: 40px;
                  height: 40px;
                  border: 1px solid #ccc;
                  border-radius: 6px;
                }
              }
              .info {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                .s-name {
                  padding-bottom: 5px;
                }
                .s-info {
                  font-size: 12px;
                  display: flex;
                  flex-direction: row;
                  align-items: center;
                  justify-content: flex-start;
                  > div {
                    background-color: #efefef;
                    .line {
                      padding-left: 5px;
                      padding-right: 5px;
                    }
                  }
                  i {
                    padding-left: 5px;
                    font-style: normal;
                    &:before {
                      content: " ";
                    }
                  }
                }
              }
            }
            .item-right {
              color: #f00;
            }
          }
        }
      }
    }
  }
  .nav-sales {
    color: #df5420 !important;
    font-weight: bold;
  }
}
</style>
