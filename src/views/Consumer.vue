<template>
  <div class="consumer">
    <Top title="客户管理" />
    <div class="content">
      <mt-loadmore :top-method="loadTop" :bottom-method="loadBottom" :bottom-all-loaded="allLoaded" ref="loadmore">
        <ul class="list">
          <li v-for="(item,index) in list" :key="index">
            <p>{{item.kehu_name}}</p>
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
      allLoaded: false,
      list: []
    };
  },
  methods: {
    loadTop() {
      console.log(this);
      this.$refs.loadmore.onTopLoaded();
    },
    loadBottom() {
      console.log(this);
      this.$refs.loadmore.onBottomLoaded();
    },
    loadList() {
      this.$http.get("http://vue.dev.com/data/consumerlist.php").then(
        function(res) {
          console.log(res);
          this.list = this.list.concat(res.data);
        }.bind(this)
      );
    }
  },
  created() {
    this.loadList();
  }
};
</script>

<style scoped lang="less">
</style>
