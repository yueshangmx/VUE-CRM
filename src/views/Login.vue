<template>
  <div class="login">
    <h1>登录CRM</h1>
    <div>
      <el-form :model="ruleForm" status-icon :rules="rules2" ref="ruleForm" label-width="80px" class="ruleForm">
        <el-form-item label="账号" prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pass">
          <el-input type="password" v-model="ruleForm.pass" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    let checkname = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("账号不能为空"));
      } else {
        callback();
      }
    };
    let validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入密码"));
      } else {
        callback();
      }
    };
    return {
      ruleForm: {
        pass: "",
        name: ""
      },
      rules2: {
        pass: [{ validator: validatePass, trigger: "blur" }],
        name: [{ validator: checkname, trigger: "blur" }]
      }
    };
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          console.log("登录成功");
          localStorage.setItem("info", "admin");
        } else {
          console.log("登录失败！！");
          return false;
        }
      });
    }
  }
};
</script>

<style lang="less">
.login {
  margin: 0 auto;
  .el-form {
    padding-right: 40px;
    .el-button {
      width: 100%;
    }
  }
}
</style>
