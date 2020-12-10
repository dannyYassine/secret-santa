<template>
  <div id="app">
    <div class="xmas-background">

    </div>
    <div class="app-content">
      <img alt="Vue logo" src="./assets/logo.png">
      <HelloWorld msg="Secret Santa!"/>
      <div>
        <p v-if="loading">Loading</p>
        <p v-if="hasMessage">{{ message }}</p>
      </div>
      <div>
        <a href='https://www.freepik.com/vectors/pattern'>Pattern vector created by mokoland - www.freepik.com</a>
      </div>
    </div>
  </div>
</template>

<script>
import HelloWorld from '/@/components/HelloWorld.vue'
import { apiAxios } from '/@/helpers/AxiosHelper';

export default {
  name: 'App',
  components: {
    HelloWorld
  },
  data() {
    return {
      loading: true,
      message: null
    }
  },
  computed: {
    hasMessage() {
      return !this.loading && this.message;
    }
  },
  methods: {
    async loadMessage() {
      this.loading = true;
      const data = await apiAxios.get('/stay-alive');
      this.message = data.data.data;
      console.log(this.message);
      this.loading = false;
    }
  },
  mounted() {
    this.loadMessage();
  }
}
</script>

<style scoped lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  height: 100vh;

  .app-content {
    position: relative;
    z-index: 1;
  }
}
</style>
