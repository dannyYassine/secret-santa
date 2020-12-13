<template>
  <div>
    <b-field label="Street Number">
      <b-input v-model="address.streetNumber" data-e2e="address-input-street-number"></b-input>
    </b-field>
    <b-field label="Street Name">
      <b-input v-model="address.streetName" data-e2e="address-input-street-name"></b-input>
    </b-field>
    <b-field label="City">
      <b-input v-model="address.city" data-e2e="address-input-city"></b-input>
    </b-field>
    <b-field label="Postal Code">
      <b-input v-model="address.postalCode" data-e2e="address-input-postal-code"></b-input>
    </b-field>
  </div>
</template>

<script>
import { Address } from '@/models/Address';

export default {
  name: 'AddressForm',
  props: {
    address: { type: Address }
  }
}
</script>

<style scoped>

</style>