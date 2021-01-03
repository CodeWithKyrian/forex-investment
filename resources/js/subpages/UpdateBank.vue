<template>
    <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1 bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto"  transition="sub-page" overlayTransition="overlay">
      <div class="w-full py-8 px-4 bg-white flex items-center text-gray-500 ">
          <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
            <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">{{pageDets.title}}</h2>
      </div>
      <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
        <div class="">
          <p class="text-gray-800">{{pageDets.info}}</p>
        </div>
        <form class="my-6" @submit.prevent="submitBankDetails">
          <input-field name="account_number" type="number" :value="user.bank_account_verified?user.bank_account_number: ''"></input-field>
          <select-box name="bank" :options="banks" :selected="user.bank_account_verified?user.bank_code: ''"></select-box>
          <button class="w-full flex items-center justify-center text-lg text-white bg-blue-800 border border-blue-800 hover:bg-none h-14 rounded-md cursor-pointer mt-12">
              <font-awesome-icon icon="spinner" class="animate-spin mx-4" v-show="loading"></font-awesome-icon>
              <span v-show="loading">Verifying...</span> 
              <span v-show="!loading">VERIFY ACCOUNT</span> 
          </button>
          <p class="text-gray-600 pt-2">Verification of account takes not more than 3 mins. However, if after 2hrs and your account haven't been verified, please contact our customer care or send a DM to any of our social media pages</p>
          <div class="flex items-center justify-center text-lg text-red-500 border border-red-500 hover:text-red-600  hover:border-red-600 bg-none h-16 rounded-md cursor-pointer mt-12" @click="back">
           <p>CANCEL</p>
          </div>
        </form>
      </div>
    </vue-final-modal>
</template>

<script>
import InputField from '../blocks/InputField.vue';
import LargeButton from '../blocks/LargeButton.vue';
import SelectBox from '../blocks/SelectBox.vue';
import StringSimilarity from 'string-similarity';

export default {
  data: () => ({
    open: true,
    banks: [],
    loading: false
  }),
  components: {
    LargeButton,
    InputField,
    SelectBox
  },
  computed: {
    user(){
      return this.$store.state.user
    },
    pageDets(){
      if(this.user.bank_account_verified)
        return {
          title: "Update Account Details",
          info: "Please note that you can only update your account details twice. For any further complaint, be sure to contact us via our email or any of our social media pages"
        }
      else
        return {
          title: "Add an account",
          info: "Add your bank account where you receive the payouts. Ensure the name on your bank account corresponds with the name you used for registeration"
        }
    }
  },
  mounted(){
     this.loadBanks()
  },
  methods: {
    back(){
      this.open = false;
      setTimeout(() => {
        this.$router.push('/account')
      }, 500);
    },
    submitBankDetails(e){
      this.loading = true;
      var id = this.user.id
      var data = {}

      const form = e.target
      const formData = new FormData(form)
      for (const [name, value] of formData) {
        var inputField = {}
        data[name] = value
      }
      axios.post('/api/banks/verify', data)
        .then(res => {
          const result = res.data
          if(result.status)
          {
            const accountInfo = result.data
            const nameFromBank = accountInfo.account_name
            const similarity = this.compareName(nameFromBank);
            if(similarity > 0.5){
              //The details are correct and the registered name matches the bank account
              this.loading = false
              Swal.fire({
                icon: 'success',
                title: 'Account Verified',
                text: accountInfo.account_name,
                showConfirmButton: false
              })
              this.updateBankDetails(data)
            }
            else{
              // The details are correct but the registered name doesn't match the bank account
              this.loading = false
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'The name on the account does not match the name you registered this account with. Edit your profile details and try again'
              })
            }
          }
          else{
            // The bank account does not exist
            this.loading = false
            Swal.fire({
              icon: 'error',
              title: 'Wrong Details',
              text: "This combination of account number and bank name does not exist. Please check the details you provided and try again"
            })
          }
        })
        .catch(()=>{
          // Something else is happening probably network problem
          this.loading = false
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'There is something wrong with your connection'
            })
        })
    },
    updateBankDetails(data){
      var id = this.user.user_id
      var bank_account_number = parseInt(data.account_number)
      var bank_code = data.bank.toString().padStart(3, "0");

      axios.put('/api/users/'+ id, {
        bank_account_number: bank_account_number,
        bank_code: bank_code,
        bank_account_verified: 1
      })
      .then(res =>{
        this.$store.dispatch("loadUser")
        setTimeout(() => {
          this.loading = false
          this.back()
          Toast.fire('Bank Details updated succesfully', '', 'info')
        }, 1000);
      })
      .catch(err=>{
        console.log(err)
      })
    },
    loadBanks(){
      axios.get('/api/banks')
      .then(res => this.banks = res.data)
      .catch(res=>{})
    },
    compareName(name){
      const registeredName = this.user.first_name + " " + this.user.last_name
      const str1 = registeredName.toLowerCase()
      const str2 = name.toLowerCase()

      var similarity = StringSimilarity.compareTwoStrings(str1, str2);
      return similarity;
    }
  }
}
</script>


<style scoped>

</style>
