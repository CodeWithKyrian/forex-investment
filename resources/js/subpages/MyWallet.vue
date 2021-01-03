<template>
  <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1  bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto" transition="sub-page" overlayTransition="overlay">
    <div class="w-full py-8 px-4 bg-white flex items-center text-gray-500 ">
      <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
        <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">My Wallet</h2>
    </div>
    <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
      <div class="mt-8">
          <div class="w-full border border-gray-300 rounded-md flex flex-col justify-between mb-12">
            <div class="mb-6 p-4">
              <p class="uppercase text-sm">Balance</p>
              <p class="text-4xl font-bold text-blue-800">{{walletBalance}}</p>
            </div>
            <div class="grid grid-cols-2">
              <button class="border-t border-r border-gray-300 p-4" @click="$router.push('/wallet/deposit')">
                <font-awesome-icon icon="arrow-down" class="text-blue-800"></font-awesome-icon>
                <span>Deposit</span>
              </button>
              <button class="border-t border-gray-300 p-4"  @click="$router.push('/wallet/withdraw')">
                <font-awesome-icon icon="arrow-up" class="text-blue-800"></font-awesome-icon>
                <span>Withdraw</span>
              </button>
            </div>
          </div>
          <div class="w-full border border-gray-300 rounded-md flex flex-col p-4">
            <p>Transactions</p>
            <ul class="py-4">
              <transaction v-for="transaction in transactions" :key="transaction.id" :amount="transaction.amount" :confirmed="transaction.confirmed" :type="transaction.type"></transaction>
            </ul>
          </div>
      </div>
    </div>
    <!-- SUBPAGES UNDER THIS -->
    <router-view></router-view>
  </vue-final-modal>
</template>

<script>
import LargeButton from '../blocks/LargeButton.vue';
import Transaction from '../blocks/Transaction.vue';
export default {
  data: () => ({
    open: true,
    transactions: []
  }),
  components: {
    LargeButton,
    Transaction,
  },
  computed: {
    user() {
        return this.$store.state.user;
    },
    walletBalance(){
        var balance =  new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(this.user.wallet_balance || 0)
        return balance
    }
  },
  mounted(){
    this.getTransactions();
  },
  methods: {
    getTransactions(){
      axios.get('/api/wallet/get_user_transactions')
      .then(res=>{
        this.transactions = res.data
      })
      .catch(err => {})
    },
    back(){
      this.open = false;
      setTimeout(() => {
        this.$router.push('/')
      }, 500);
    }
  }
}
</script>


<style scoped>
</style>
