<template>
  <div class="main">

  </div>
</template>

<script>
export default {
  name: "Main"
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-around;
  box-sizing: border-box;
  li {
    width: 65px;
    height: 65px;
    padding: 5px;
    background-color: #df5420;
    border: 1px solid #eee;
    a {
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      i {
        font-size: 30px;
      }
    }
  }
}
</style>
