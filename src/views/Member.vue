<template>
  <div class="memeber">
    <Top title="员工管理" />
    <div class="m-main">
      <ul class="list">
        <li v-for="(item,index) in list" :key="index">
          <router-link :to="'/mdetails/'+item.id">
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
    </div>
  </div>
</template>

<script>
import Top from "@/components/Top.vue";
export default {
  name: "Member",
  components: {
    Top
  }
};
</script>

<style scoped lang="less">
</style>
