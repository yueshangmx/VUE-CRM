<template>
  <div class="welcome">
    <h2 class="content">这是欢迎页</h2>
    <!--<img :src="imgsrc" alt="">-->
  </div>
</template>

<script>
export default {
  name: "Welcome",
  data() {
    return {
      imgsrc: ""
    };
  },
  created() {
    this.getImgUrl();
  },
  methods: {
    getImgUrl() {
      let _w = window.innerWidth;
      let _H = window.innerHeight;
      let url = "https://cn.bing.com/ImageResolution.aspx?w=" + _w + "&h=" + _H;
      this.imgsrc = url;
    }
  }
};
</script>

<style lang="less">
body {
  margin: 0;
  background: linear-gradient(#37ab2f,#372b2f);
  .welcome {
    .content {
      z-index: 99;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 40%;
    }
    /*img {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -99;
      filter: blur(2px);
    }*/
  }
}
</style>
