<template>
  <div class="setfenlei">
    <div class="sf-top">
      <mt-header title="商品分类管理">
        <router-link to="/goods" slot="left">
          <mt-button icon="back"></mt-button>
        </router-link>
      </mt-header>
    </div>
    <div class="sf-main">
      <mt-loadmore :top-method="loadTop" ref="loadmore">
        <ul class="sf-list">
          <li v-for="(item,index) in list" :key="index" class="item-list">
            <div class="sf-left">{{item.fenlei_name}}</div>
            <div class="sf-right" v-if="item.fenlei_parent_id != 0">
              <i class="iconfont icon-yijianfankui" @click="editfenlei(item.fenlei_name,item.fenlei_id)"></i>
              <i class="iconfont icon-delete" @click="deletefenlei(item.fenlei_name,item.fenlei_id)"></i>
            </div>
          </li>
        </ul>
      </mt-loadmore>
    </div>
    <div class="sf-add" @click="addfenlei">
      <i class="iconfont icon-jiajianzujianjiahao"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: "setfenlei",
  data() {
    return {
      list: []
    };
  },
  methods: {
    getList() {
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
              this.list = res.data;
            } else {
              this.$toast({
                message: "读取出错！",
                iconClass: "iconfont icon-cuowu"
              });
            }
          }.bind(this)
        );
    },
    loadTop() {
      this.getList();
      this.$refs.loadmore.onTopLoaded();
    },
    editfenlei(name, id) {
      this.$messagebox
        .prompt("确定将分类：" + name + "更名吗？", "")
        .then(data => {
          this.$http
            .post(
              this.$store.state.SERVER + "/data/setfenlei.php",
              this.$Qs.stringify({
                parent_id: this.$store.state.userinfo.user_id,
                fenlei_id: id,
                fenlei_name: data.value
              })
            )
            .then(
              function(res) {
                if (res.data.result) {
                  this.$toast({
                    message: "修改成功！",
                    iconClass: "iconfont icon-icon31"
                  });
                  this.getList();
                } else {
                  this.$toast({
                    message: "修改失败",
                    iconClass: "iconfont icon-cuowu"
                  });
                }
              }.bind(this)
            );
        });
    },
    deletefenlei(name, id) {
      this.$messagebox.confirm("确定删除此分类：" + name + "？").then(() => {
        this.$http
          .post(
            this.$store.state.SERVER + "/data/setfenlei.php",
            this.$Qs.stringify({
              parent_id: this.$store.state.userinfo.user_id,
              fenlei_id: id
            })
          )
          .then(
            function(res) {
              if (res.data.result) {
                this.$toast({
                  message: "删除成功！",
                  iconClass: "iconfont icon-icon31"
                });
                this.getList();
              } else {
                this.$toast({
                  message: "删除失败",
                  iconClass: "iconfont icon-cuowu"
                });
              }
            }.bind(this)
          );
      });
    },
    addfenlei() {
      this.$messagebox.prompt("请输入商品分类名称", "").then(data => {
        this.$http
          .post(
            this.$store.state.SERVER + "/data/setfenlei.php",
            this.$Qs.stringify({
              parent_id: this.$store.state.userinfo.user_id,
              fenlei_name: data.value
            })
          )
          .then(
            function(res) {
              if (res.data.result) {
                this.$toast({
                  message: "添加成功！",
                  iconClass: "iconfont icon-icon31"
                });
                this.getList();
              } else {
                this.$toast({
                  message: "添加失败",
                  iconClass: "iconfont icon-cuowu"
                });
              }
            }.bind(this)
          );
      });
    }
  },
  created() {
    if (!this.$store.state.userinfo.user_id) {
      this.$store.commit("updateUserInfo");
    }
    this.getList();
  }
};
</script>

<style scoped lang="less">
.setfenlei {
  .sf-top {
    .mint-header {
      background-color: #df5420;
    }
  }
  .sf-main {
    .sf-list {
      margin-top: 0;
      list-style: none;
      padding-left: 0;
      padding-bottom: 100%;
      .item-list {
        font-size: 14px;
        border-bottom: 1px solid #ccc;
        padding: 12px 5px 12px 10px;
        background-color: #fff;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        .sf-left {
          height: 22px;
        }
        .sf-right {
          i {
            margin-right: 15px;
            font-size: 18px;
            font-weight: bold;
          }
          .icon-delete {
            font-size: 20px;
          }
        }
      }
    }
  }
  .sf-add {
    i {
      position: fixed;
      right: 30px;
      bottom: 50px;
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
