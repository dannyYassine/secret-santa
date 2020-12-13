<template>
  <div>
    <b-field label="Name">
      <b-input v-model="friend.name" data-e2e="friend-input-name"></b-input>
    </b-field>
    <b-field label="Email">
      <b-input type="email"
               v-model="friend.email"
               data-e2e="friend-input-email">
      </b-input>
    </b-field>
    <AddressForm :address="friend.address" />
  </div>
</template>

<script>
import { Friend } from '@/models/Friend';
import AddressForm from "@/components/AddressForm";

export default {
  name: 'FriendForm',
  components: {AddressForm},
  props: {
    friend: { type: Friend }
  }
}
</script>

<style scoped>

</style>