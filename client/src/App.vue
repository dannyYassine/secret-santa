<template>
  <div id="app">
    <div class="xmas-background">

    </div>
    <div class="app-content">
      <HelloWorld msg="Welcome to Secret Santa!"/>
      <div>
        <FriendForm v-for="friend in friends" :key="friend.email" :friend="friend"/>
      </div>
      <b-button type="is-primary is-light" @click="addFriendClicked">Add Friend</b-button>
      <b-button type="is-success is-light" @click="onSendClicked">Send</b-button>
      <div>
        <a href='https://www.freepik.com/vectors/pattern'>Pattern vector created by mokoland - www.freepik.com</a>
      </div>
    </div>
  </div>
</template>

<script>
import HelloWorld from '/@/components/HelloWorld.vue'
import { apiAxios } from '/@/helpers/AxiosHelper';
import {Friend} from "@/models/Friend";
import FriendForm from "@/components/FriendForm";

export default {
  name: 'App',
  components: {
    FriendForm,
    HelloWorld
  },
  data() {
    return {
      loading: true,
      message: null,
      friends: []
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
      this.loading = false;
    },
    addFriendClicked() {
      this.friends.push(new Friend());
    },
    async onSendClicked() {
      try {
        this.loading = true;
        await apiAxios.post('/distribute', {friends: this.friends});
      } finally {
        this.loading = false;
      }
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
