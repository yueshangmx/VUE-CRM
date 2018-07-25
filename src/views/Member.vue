<template>
  <div class="member">
    <Top title="员工管理" />
    <div class="m-main">
      <div class="m-total">员工总数：{{total}}</div>
      <ul class="m-list">
        <li v-for="(item,index) in list" :key="index">
          <router-link :to="'/member-details/'+item.id">
            <div class="d-left">
              <i class="iconfont icon-kehuguanli"></i>
              <div class="d-name-p">
                <div class="detail-name"></div>
                <div class="detail-phone"></div>
              </div>
            </div>
            <div class="d-right">
              <i class="iconfont icon-viphuiyuan"></i>
              <i class="iconfont icon-jiantouyou"></i>
            </div>
          </router-link>
        </li>
      </ul>
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
  }
};
</script>

<style scoped lang="less">
.member {
  .m-list {
    list-style: none;
    background-color: #fff;
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
