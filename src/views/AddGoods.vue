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
        <mt-field label="商品分类" :attr="{style:'display:none'}">
          <select name="fenlei" class="ag-fenlei" v-model="goodsinfo.fenlei">
            <option v-for="item in fenleilist" :key="item.fenlei_id" :value="item.fenlei_id">{{item.fenlei_name}}</option>
          </select>
        </mt-field>
      </div>
      <div class="ag-part">
        <mt-field type="number" label="商品进价" v-model="goodsinfo.jinjia" :state="checkinfo.jinjia" placeholder="0.00">元</mt-field>
        <mt-field type="number" label="商品售价" v-model="goodsinfo.price" :state="checkinfo.price" placeholder="0.00">元</mt-field>
        <mt-field type="number" label="商品库存" v-model="goodsinfo.inventory" :state="checkinfo.inventory" placeholder="0">台</mt-field>
      </div>
      <div class="ag-part">
        <mt-field type="textarea" label="备注" v-model="goodsinfo.beizhu" placeholder="商品备注"></mt-field>
      </div>
    </div>
    <div class="submit">
      <mt-button type="default" size="small" @click="goback">取消添加</mt-button>
      <mt-button type="default" size="small" @click="submit">保存继续</mt-button>
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
        fenlei: "1",
        beizhu: "",
        imgarr: []
      },
      checkinfo: {
        name: "",
        jinjia: "",
        price: "",
        inventory: ""
      },
      piclist: [],
      picflag: true,
      fenleilist: []
    };
  },
  watch: {
    piclist: {
      handler: function(newVal) {
        this.goodsinfo.imgarr = newVal;
      },
      deep: true
    },
    "goodsinfo.name": function() {
      if (!this.goodsinfo.name) {
        this.checkinfo.name = "";
      } else {
        let reg = /^[\w\-\u4e00-\u9fa5]{2,20}$/;
        this.checkinfo.name = reg.test(this.goodsinfo.name)
          ? "success"
          : "warning";
      }
    },
    "goodsinfo.jinjia": function() {
      if (!this.goodsinfo.jinjia) {
        this.checkinfo.jinjia = "";
      } else {
        let reg = /^[1-9|0.]\d*[.]*(\d{1,2})?$/;
        this.checkinfo.jinjia = reg.test(this.goodsinfo.jinjia)
          ? "success"
          : "warning";
      }
    },
    "goodsinfo.price": function() {
      if (!this.goodsinfo.price) {
        this.checkinfo.price = "";
      } else {
        let reg = /^[1-9|0.]\d*[.]*(\d{1,2})?$/;
        this.checkinfo.price = reg.test(this.goodsinfo.price)
          ? "success"
          : "warning";
      }
    },
    "goodsinfo.inventory": function() {
      if (this.goodsinfo.inventory == 0) {
        this.checkinfo.inventory = "";
      } else {
        let reg = /^([1-9]\d*)$/;
        this.checkinfo.inventory = reg.test(this.goodsinfo.inventory)
          ? "success"
          : "warning";
      }
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
    getFenlei() {
      this.$http
        .post(
          this.$store.state.SERVER + "/data/setfenlei.php",
          this.$Qs.stringify({
            parent_id: this.$store.state.userinfo.user_parent_id
          })
        )
        .then(
          function(res) {
            if (res.data.length > 0) {
              this.fenleilist = res.data;
            } else {
              this.$toast({
                message: "读取分类列表出错！",
                iconClass: "iconfont icon-cuowu"
              });
            }
          }.bind(this)
        );
    },
    submit() {
      if (this.goodsinfo.imgarr.length > 0) {
        if (this.goodsinfo.name && this.goodsinfo.price) {
          if (
            this.checkinfo.name == "success" &&
            this.checkinfo.price == "success" &&
            this.checkinfo.jinjia != "warning" &&
            this.checkinfo.inventory != "warning"
          ) {
            this.$http
              .post(
                this.$store.state.SERVER + "/data/add_goods.php",
                this.$Qs.stringify(this.goodsinfo)
              )
              .then(
                function(res) {
                  console.log(res);
                  if (res.data.result) {
                    this.$toast({
                      message: "添加成功！",
                      iconClass: "iconfont icon-icon31"
                    });
                    this.$router.go(0);
                  } else {
                    this.$toast({
                      message: "添加失败！请重新提交",
                      iconClass: "iconfont icon-cuowu"
                    });
                  }
                }.bind(this)
              );
          } else {
            this.$toast({
              message: "数据格式不正确！",
              iconClass: "iconfont icon-cuowu"
            });
          }
        } else {
          this.$toast({
            message: "商品名和售价不能为空！",
            iconClass: "iconfont icon-cuowu"
          });
        }
      } else {
        this.$toast({
          message: "请至少添加一张图片！",
          iconClass: "iconfont icon-cuowu"
        });
      }
    },
    goback() {
      this.$router.replace({ path: "/goods" });
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getFenlei();
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
            padding-right: 60px;
          }
          .mint-field-state {
            position: absolute;
            right: 10px;
          }
          .mint-field-clear {
            position: absolute;
            right: 30px;
          }
          .mint-field-other {
            position: absolute;
            right: 50px;
            margin-top: 1px;
            line-height: 45px;
            .ag-fenlei {
              height: 45px;
              border: 0;
            }
          }
        }
      }
    }
  }
  .mint-cell-wrapper {
    padding-left: 0;
  }
  .submit {
    position: fixed;
    bottom: 0;
    border-top: 1px solid #aaa;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    padding: 10px 0;
    background-color: #fff;
    .mint-button {
      background-color: #df5420;
      color: #fff;
    }
  }
}
</style>
