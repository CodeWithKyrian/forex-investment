<template>
  <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
      <div class="cursor-pointer relative rounded-full w-28 h-28 mx-auto">
        <img src="/img/kyrian.png" class="w-full h-full rounded-full object-cover"/>
      </div>
      <div class="text-center my-4">
        <div class="text-2xl font-bold">{{user.first_name }} {{user.last_name}}</div>
        <div class="text-xl">{{user.xid}}</div>
      </div>
      <div class="w-full sm:w-2/3 md:w-1/2 my-4 mx-auto">
        <div class="">
            <large-button icon="user" text="My Account Setting" @click.native="$router.push('/account/account-settings')">
            </large-button>
            <large-button icon="credit-card" text="My Bank Setting" @click.native="$router.push('/account/bank-settings')"></large-button>
            <large-button icon="pen-square" text="KYC Verification"></large-button>
            <large-button icon="phone" text="Contact Us"  @click.native="$router.push('/contact')"></large-button>
            <large-button icon="sign-out-alt" text="Logout" @click.native="logout"></large-button>
        </div>
      </div>
      <router-view></router-view>
    </div>
</template>

<script>
import LargeButton from '../blocks/LargeButton.vue'
export default {
    data(){
        return{}
    },
    components: {LargeButton},
    mounted(){
     this.$store.commit('changecurrPage', "account")
    },
    computed: {
      user(){
        return this.$store.state.user
      }
    },
    methods :{
      logout(){
        Swal.fire({
          icon: 'question',
          title: 'Are you sure you want to logout?',
          showDenyButton: true,
          confirmButtonText: 'Yes',
          denyButtonText: 'No'
        })
        .then(result => {
          if(result.isConfirmed){
            this.$store.dispatch('logout')
            window.location.assign(process.env.MIX_APP_URL + "/login")
          }
        })
      }
    },
    watch: {
    }
}
</script>

<style>

</style>