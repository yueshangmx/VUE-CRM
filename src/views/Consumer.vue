<template>
  <div class="consumer">
    <Top title="客户管理" />
    <div class="content">
      <div class="total">客户总数：{{total}}</div>
      <mt-loadmore :top-method="loadTop" :bottom-method="loadBottom" :bottom-all-loaded="allLoaded" ref="loadmore">
        <ul class="list">
          <li v-for="(item,index) in list" :key="index">
            <router-link :to="'/details/'+item.id">
              <div class="d-left">
                <i class="iconfont icon-kehuguanli"></i>
                <div class="d-name-p">
                  <div class="detail-name">{{item.kehu_name}}</div>
                  <div class="detail-phone">{{item.kehu_phone}}</div>
                </div>
              </div>
              <div class="d-right">
                <i class="iconfont icon-viphuiyuan" v-if="item.kehu_vip_id == 2"></i>
                <i class="iconfont icon-jiantouyou"></i>
              </div>
            </router-link>
          </li>
        </ul>
      </mt-loadmore>
    </div>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "consumer",
  components: {
    Top
  },
  data() {
    return {
      total: "",
      allLoaded: false,
      list: [], //存放返回的客户数据
      start: 0, //数据开始的id
      count: 10, //一次获取的数据量
      user_id: ""
    };
  },
  methods: {
    loadTop() {
      this.start = 0;
      this.list = [];
      this.loadList({ user_id: this.user_id });
      this.loadList({
        user_id: this.user_id,
        start: this.start,
        count: this.count
      });
      this.$refs.loadmore.onTopLoaded();
    },
    loadBottom() {
      this.loadList({
        user_id: this.user_id,
        start: this.start,
        count: this.count
      });
      this.$refs.loadmore.onBottomLoaded();
    },
    loadList(data) {
      this.$http
        .post(
          "http://vue.dev.com/data/consumerlist.php",
          this.$Qs.stringify(data)
        )
        .then(
          function(res) {
            if (res.data.total) {
              this.total = res.data.total;
            } else {
              this.list = this.list.concat(res.data);
              this.start += 10;
            }
          }.bind(this)
        );
    }
  },
  created() {
    this.user_id = JSON.parse(window.sessionStorage.getItem("info")).user_id;
    this.loadList({ user_id: this.user_id });
    this.loadList({
      user_id: this.user_id,
      start: this.start,
      count: this.count
    });
  }
};
</script>

<style scoped lang="less">
.consumer {
  .content {
    .total {
      height: 24px;
      line-height: 24px;
      font-size: 12px;
      text-align: left;
      padding-left: 10px;
    }
    .list {
      margin-top: 0;
      list-style: none;
      padding-left: 10px;
      background-color: #fff;
      li {
        padding: 2px 10px 2px 0;
        border-bottom: 1px solid #ccc;
        a {
          color: #999;
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: space-between;
          height: 50px;
          .d-left {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            i {
              color: #f2f2f2;
              background: #aaa;
              height: 40px;
              width: 40px;
              border-radius: 5px;
              font-size: 2rem;
              line-height: 40px;
              margin-right: 10px;
            }
            .d-name-p {
              text-align: left;
              .detail-name {
                color: #333;
                padding-bottom: 2px;
              }
              .detail-phone {
                color: #555;
                font-size: 14px;
              }
            }
          }
          .d-right {
            i {
              padding-left: 5px;
            }
            .icon-viphuiyuan {
              color: #f00;
            }
            .icon-jiantouyou {
              color: #999;
              font-size: 12px;
            }
          }
        }
      }
    }
  }
}
</style>
