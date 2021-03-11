<template>
  <div class="login-container chat-box">
    <div class="inputs">
      <div class="" v-if="message"> {{message}} </div>
      <button type="submit" class="submit" v-on:click="login"> Submit </button>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      message: ""
    }
  },
  methods: {
    login: function() {
      this.$emit("authenticated", {email: 'anis@gmail.com', name: 'amis'});
    }
  }
}
</script>

<style scoped>
.login-container {
  display: grid;
}
input[type="text"] {
  padding: 10px 8px;
  margin-top: 10px;
  border-radius: 2px;
  border: 1px solid darkgray;
  font-size: 16px;
  box-sizing: border-box;
  display: block;
  width: 300px;
}
.inputs {
  text-align: center;
  align-self: center;
  justify-self: center;
}
.submit {
  width: 300px;
  margin-top: 9px;
  padding: 10px 60px;
  background: rgb(99, 99, 212);
  color: white;
  font-size: 16px;
}
</style>
