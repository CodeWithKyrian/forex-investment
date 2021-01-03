<template>
  <li class="grid grid-cols-12 mb-6">
    <span class="col-span-1">
        <font-awesome-icon :icon="confirmed? 'check-circle' : 'times-circle'" :class="confirmed? 'text-green-600' : 'text-red-600'" size="sm"></font-awesome-icon>
    </span>
    <span class="col-span-8">{{description}}</span>
    <span class="col-span-3 text-right">{{ amount | currencyNGN }}</span>
  </li>
</template>

<script>
export default {
    props: {
        amount: String,
        confirmed: Number, 
        type: String
    },
    filters: {
      currencyNGN(value) {
        return new Intl.NumberFormat('en-NG', {style: 'currency', currency: 'NGN'}).format(value)
      }
    },
    computed: {
        description(){
            if (this.type == 'deposit'){
                return 'Cash deposit from bank'
            }
        }
    }
}
</script>

<style>

</style>