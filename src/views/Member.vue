<template>
  <div class="member">
    <Top title="员工管理" />
    <div class="m-main">
      <div class="m-total">员工总数：{{total}}
        <router-link to="/group">
          <i class="iconfont icon-shezhi"></i>
        </router-link>
      </div>
      <mt-loadmore :top-method="loadTop" ref="loadmore">
        <ul class="m-list">
          <li v-for="(item,index) in list" :key="index">
            <router-link :to="'/member-details/'+item.id">
              <div class="d-left">
                <div class="d-name-p">
                  <div class="detail-name">{{item.user_currenname}}</div>
                  <div class="d-group" v-if="item.user_group_id == 1">（超级管理员）</div>
                  <div class="d-group" v-else-if="item.user_group_id == 2">（管理员）</div>
                  <div class="d-group" v-else-if="item.user_group_id == 3">（店长）</div>
                  <div class="d-group" v-else>（员工）</div>
                </div>
              </div>
              <div class="d-right"  >
                <div class="d-r-dept">{{item.dept_name}}</div>
                <i class="iconfont icon-jiantouyou"></i>
              </div>
            </router-link>
          </li>
        </ul>
      </mt-loadmore>
    </div>
    <router-link to="/addMember" class="m-add" >
      <i class="iconfont icon-jiajianzujianjiahao"></i>
    </router-link>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "Member",
  data() {
    return {
      total: "",
      list: []
    };
  },
  components: {
    Top
  },
  methods: {
    getMemberList() {
      this.$http
        .post(
          this.$store.state.SERVER + "/data/memberlist.php",
          this.$Qs.stringify({ parent_id: this.$store.state.userinfo.user_id })
        )
        .then(
          function(res) {
            if (res.data) {
              this.total = res.data.length;
              this.list = res.data;
            } else {
              this.$toast({
                message: "服务器响应出错！",
                iconClass: "iconfont icon-cuowu"
              });
            }
          }.bind(this)
        );
    },
    loadTop() {
      this.getMemberList();
      this.$refs.loadmore.onTopLoaded();
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getMemberList();
  }
};
</script>

<style scoped lang="less">
.member {
  .m-main {
    .m-total {
      text-align: left;
      padding: 5px 10px;
      font-size: 12px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      i {
        font-weight: bold;
        color: #333;
        font-size: 18px;
      }
    }
    .m-list {
      list-style: none;
      background-color: #fff;
      margin: 0;
      padding-left: 10px;
      padding-bottom: 100%;
      li {
        border-bottom: 1px solid #ccc;
        padding: 10px 10px 10px 0;
        a {
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: space-between;
          .d-left {
            .d-name-p {
              display: flex;
              flex-direction: row;
              align-items: center;
              justify-content: flex-start;
              font-size: 14px;
              color: #333;
            }
          }
          .d-right {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            font-size: 14px;
            color: #999;
            i {
              font-size: 12px;
              padding-left: 10px;
            }
          }
        }
      }
    }
  }
  .m-add {
    i {
      position: fixed;
      right: 30px;
      bottom: 30px;
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
