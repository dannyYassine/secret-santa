<template>
  <div>
    <b-field label="Name">
      <b-input v-model="friend.name"></b-input>
    </b-field>
    <b-field label="Email"
             type="is-danger"
             message="This email is invalid">
      <b-input type="email"
               v-model="friend.email">
      </b-input>
    </b-field>
  </div>
</template>

<script>
import { Friend } from '@/models/Friend';

export default {
  name: 'FriendForm',
  props: {
    friend: { type: Friend }
  }
}
</script>

<style scoped>

</style>