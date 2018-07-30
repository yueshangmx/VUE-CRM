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
        id: "",
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
          console.log(res.data);
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
  }
  .mint-cell-wrapper {
    padding-left: 0;
  }
}
</style>
