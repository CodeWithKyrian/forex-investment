<template>
  <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1  bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto"  transition="sub-page" overlayTransition="overlay">
    <div :class="classes.heading">
        <div class="w-full py-8 px-4 flex items-center">
            <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
              <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">Bank Account</h2>
        </div>
        <p>This account is where you receive the payout of your investments on XChequer on maturity. Funds are disbursed instantly.</p>
    </div>
    <div class="w-full max-w-screen-xl py-6 px-6">
      <div :class="classes.infoBox">
        <div v-if="user.bank_account_verified">
          <h2 class="mb-12 font-bold">{{user.bank_name}}</h2>
          <p class="">{{user.bank_account_number}}</p>
          <p class="">{{user.first_name}} {{user.last_name}}</p>
        </div>
        <div v-else>
          <h2 class="font-bold">NO BANK DETAILS</h2>
        </div>
      </div>
      <div class="flex items-center justify-center text-lg text-white bg-blue-800 border border-blue-800 hover:bg-none h-14 rounded-md cursor-pointer mt-12" @click="$router.push({name: 'update-bank'})">
        <p>UPDATE YOUR BANK DETAILS</p>
      </div>
      <div class="flex items-center justify-center text-lg text-red-500 border border-red-500 hover:text-red-600  hover:border-red-600 bg-none h-16 rounded-md cursor-pointer mt-12" @click="back">
        <p>CANCEL</p>
      </div>
    </div>
  </vue-final-modal>
</template>

<script>
export default {
  data: () => ({
    open: true,
  }),
  methods: {
    back(){
      this.open = false;
      setTimeout(() => {
        this.$router.push('/account')
      }, 500);
    }
  },
  computed: {
    user(){
      return this.$store.state.user
    },
    classes(){
      if (this.user.bank_account_verified) {
        return{
          heading: "bg-blue-800 text-white px-4 pb-24",
          infoBox: "-mt-24 px-4 py-4 bg-red-500 text-white rounded-md uppercase text-lg"
        }
      } else {
        return{
          heading: "bg-white text-black px-4 pb-24",
          infoBox: "-mt-24 px-4 py-16 bg-blue-100 text-blue-800 rounded-md uppercase text-3xl flex align-center justify-center"
        }
      }
    }
  }
}
</script>


<style scoped>
</style>
