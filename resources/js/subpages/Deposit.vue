<template>
    <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1 bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto"  transition="sub-page" overlayTransition="overlay">
      <div class="w-full py-8 px-4 bg-white flex items-center text-gray-500 ">
        <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
          <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">Deposit</h2>
      </div>
      <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
        <form class="mt-12" @submit.prevent="initiatePayment">
          <input-field name="amount" type="number"></input-field>
          <input-field name="account_password" type="password"></input-field>
          <button class=" w-full flex items-center justify-center text-lg text-white bg-blue-800 border border-blue-800 hover:bg-none h-14 rounded-md cursor-pointer mt-12" :disabled="loading">
              <font-awesome-icon icon="spinner" class="animate-spin" v-show="loading"></font-awesome-icon>
              <span v-show="!loading">Continue</span> 
          </button>
          <div class="flex items-center justify-center text-lg text-red-500 border border-red-500 hover:text-red-600 hover:border-red-600 bg-none h-16 rounded-md cursor-pointer mt-12" @click="back">
              <p>CANCEL</p>
          </div>
        </form>
      </div>
    </vue-final-modal>
</template>

<script>
import InputField from '../blocks/InputField.vue';
export default {
  data: () => ({
    open: true,
    loading: false
  }),
  components: {InputField},
  mounted(){
    let paystackScript = document.createElement('script')
    paystackScript.setAttribute('src', 'https://js.paystack.co/v1/inline.js')
    document.body.appendChild(paystackScript)
  },
  computed: {
    user(){
      return this.$store.state.user
    }
  },
  methods:{
    back(){
      this.open = false;
      setTimeout(() => {
        this.$router.push('/wallet')
      }, 500);
    },
    async initiatePayment(e){
      this.loading = true;
      var id = this.user.user_id
      var data = {}

      const form = e.target
      const formData = new FormData(form)
      for (const [name, value] of formData) {
        var inputField = {}
        data[name] = value
      }
      const res = await axios.post('/api/confirm_user_password', data)
      if(res.data.data){
        this.payWithPaystack(data.amount)
      }
      else{
        Swal.fire('Wrong Details','The password you provided is incorrect. Please try again.','error')
        this.loading = false
      }
    },
    payWithPaystack(amount) {
      var handler = PaystackPop.setup({
        key: 'pk_test_d47771c38b5d2c20a35b7c2c8513d4429aa4a6a0',
        email: this.user.email,
        amount: amount * 100,
        currency: 'NGN', 
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
        label: this.user.first_name + ' ' +  this.user.last_name,
        callback: response => {
          var reference = response.reference;
          var id = this.user.user_id

          axios.post('/api/wallet/verify_payment', {reference, id})
          .then(res => {
            this.loading = false
            this.$store.dispatch("loadUser")
            this.back()
          })
        },
        onClose: () => {
          alert('Transaction was not completed, window closed.');
          this.loading = false
        },
      });
      handler.openIframe();
    }
  }
}
</script>


<style scoped>

</style>
