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
        <li class="pic-list" v-for="(item,index) in piclist" :key="index" v-if="item.isshow">
          <img :src="item.src" alt="" @click="removepic" :data-index="index">
        </li>
        <li class="pic-add">
          <input id="uploads" type="file" class="ag-pic" @change="uploadImages" accept="image/*" multiple/>
          <button class="btn" @click.stop="addpic" v-show="picflag"><i class="iconfont icon-jiajianzujianjiahao"></i></button>
        </li>
      </ul>
      <div class="ag-part">
        <mt-field type="text" label="商品名称" v-model="goodsinfo.name" :state="checkinfo.name" placeholder="必填"></mt-field>
        <mt-field type="text" label="商品分类" v-model="goodsinfo.fenlei" :state="checkinfo.fenlei" placeholder="必填"></mt-field>
      </div>
      <div class="ag-part">
        <mt-field type="text" label="商品进价" v-model="goodsinfo.jinjia" :state="checkinfo.jinjia" placeholder="0.00"></mt-field>
        <mt-field type="text" label="商品售价" v-model="goodsinfo.price" :state="checkinfo.price" placeholder="0.00"></mt-field>
        <mt-field type="text" label="商品库存" v-model="goodsinfo.inventory" :state="checkinfo.inventory" placeholder="0">台</mt-field>
      </div>
      <div class="ag-part">
        <mt-field type="textarea" label="备注" v-model="goodsinfo.beizhu" placeholder="商品备注"></mt-field>
      </div>
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
        id: "",
        name: "",
        jinjia: "",
        price: "",
        inventory: "0",
        fenlei: "",
        beizhu: "",
        imgarr: []
      },
      checkinfo: {
        name: "",
        fenlei: "",
        jinjia: "",
        inventory: "",
        price: ""
      },
      piclist: [],
      picflag: true
    };
  },
  watch: {
    piclist: {
      handler: function(newVal) {
        this.goodsinfo.imgarr = newVal;
      },
      deep: true
    }
  },
  methods: {
    addpic() {
      document.getElementById("uploads").click();
    },
    uploadImages(_e) {
      let e = window.event || _e;
      let that = this;
      let files = e.target.files;
      if (files.length === 5) that.picflag = false;
      for (let i = 0; i < files.length; i++) {
        let reader = new FileReader();
        reader.readAsDataURL(files[i]);
        reader.onload = function() {
          if (that.piclist.length < 5) {
            let pic = {
              isshow: false,
              src: this.result
            };
            that.piclist.push(pic);
            that.postImages(that);
          }
        };
      }
    },
    removepic(e) {
      let _e = window.event || e;
      let index = _e.target.dataset.index;
      if (this.piclist.length > 1) {
        this.piclist.splice(index, 1);
        this.postImages(this);
      } else {
        this.$toast({
          message: "请至少上传一张缩略图！",
          iconClass: "iconfont icon-cuowu"
        });
      }
    },
    postImages(that) {
      let data = {
        goods_id: that.goodsinfo.id,
        parent_id: that.$store.state.userinfo.user_parent_id,
        user_id: that.$store.state.userinfo.user_id,
        imglist: that.piclist
      };
      that.$http
        .post(
          that.$store.state.SERVER + "/data/uploadimg.php",
          that.$Qs.stringify(data)
        )
        .then(function(res) {
          if (res.data.goods_id) {
            that.goodsinfo.id = res.data.goods_id;
            for (let index in that.piclist) {
              that.piclist[index].isshow = true;
            }
            that.picflag = that.piclist.length < 5;
          } else {
            if (!res.data.result) {
              that.$toast({
                message: "图片上传失败！",
                iconClass: "iconfont icon-cuowu"
              });
              that.piclist.pop();
            } else {
              for (let index in that.piclist) {
                that.piclist[index].isshow = true;
              }
              that.picflag = that.piclist.length < 5;
            }
          }
        });
    },
    addFenlei() {
      console.log(this.goodsinfo);
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
      .mint-header-button {
        .icon-shezhi {
          font-size: 18px;
        }
      }
    }
  }
  .ag-main {
    .ag-pic {
      list-style: none;
      height: 80px;
      margin: 0;
      padding: 0 5px;
      display: flex;
      .pic-list {
        width: 20%;
        padding: 10px 0;
        img {
          box-sizing: border-box;
          width: 60px;
          height: 60px;
          border: 1px solid #ccc;
        }
      }
      .pic-add {
        .ag-pic {
          width: 20%;
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
    .ag-part {
      margin-bottom: 15px;
      .mint-field {
        .mint-cell-wrapper {
          .mint-field-core {
            padding-left: 10%;
            text-align: right;
            padding-right: 40px;
          }
          .mint-field-state {
            position: absolute;
            right: 10px;
          }
          .mint-field-other {
            right: 25px;
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
