<template>
  <div class="addgoods">
    <div class="ag-top">
      <mt-header :title="title">
        <router-link to="/goods" slot="left">
          <mt-button icon="back"></mt-button>
        </router-link>
      </mt-header>
    </div>
    <div class="ag-main">
      <ul class="ag-pic">
        <li class="pic-list" v-for="(item,index) in piclist" :key="index" v-if="piclist.length>0">
          <img :src="item.src" alt="">
        </li>
        <li class="pic-add">
          <input id="uploads" type="file" class="ag-pic" v-on:change="uploadImages" accept="image/*" multiple/>
          <button class="btn" @click="addpic" v-show="picflag"><i class="iconfont icon-jiajianzujianjiahao"></i></button>
        </li>
      </ul>
      <mt-field type="text" label="商品名称" placeholder="必填"></mt-field>
    </div>
  </div>
</template>

<script>
export default {
  name: "addgoods",
  data() {
    return {
      title: "添加商品",
      goodsinfo: {
        name: "",
        jinjia: "",
        price: "",
        inventory: "",
        fenlei: "",
        beizhu: ""
      },
      piclist: [],
      picflag: true
    };
  },
  methods: {
    addpic() {
      document.getElementById("uploads").click();
    },
    uploadImages(_e) {
      let e = window.event || _e;
      let that = this;
      let files = e.target.files;
      if (files.length == 5) that.picflag = false;
      for (let i = 0; i < files.length; i++) {
        let reader = new FileReader();
        reader.readAsDataURL(files[i]);
        reader.onload = function() {
          if (that.piclist.length < 5) {
            that.piclist.push({ src: this.result });
          }
          if (that.piclist.length == 5) that.picflag = false;
        };
      }
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
  }
};
</script>

<style lang="less">
.addgoods {
  .ag-top {
    .mint-header {
      background-color: #df5420;
    }
  }
  .ag-main {
    .ag-pic {
      list-style: none;
      height: 80px;
      margin: 0;
      padding: 0;
      display: flex;
      .pic-list {
        img {
          box-sizing: border-box;
          width: 60px;
          height: 60px;
          margin: 10px 0 0 10px;
          border: 1px solid #ccc;
        }
      }
      .pic-add {
        .ag-pic {
          display: none;
        }
        .btn {
          margin-top: 10px;
          margin-left: 10px;
          float: left;
          width: 60px;
          height: 60px;
          border: 1px solid #ccc;
          background-color: #fefefe;
          i {
            font-size: 18px;
            color: #555;
          }
        }
      }
    }
  }
  .mint-cell-wrapper {
    padding-left: 0;
  }
}
</style>
