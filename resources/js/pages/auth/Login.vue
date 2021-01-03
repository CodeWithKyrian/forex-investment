<template>
  <div class="w-5/6 sm:w-2/3 md:w-1/3 my-12 py-6 px-6 md:border mx-auto rounded-sm">
  <form class="w-full mx-auto text-center" @submit.prevent="login">
    <div class="">
      <h2 class="text-3xl font-bold text-gray-800">Welcome back</h2>
      <p class="mt-3 text-gray-800">
        New to XChequer? <a href="#" class="text-blue-400">Sign up</a>
      </p>
    </div>
    <div class="mt-12">
      <div class="my-6">
            <input type="email" name="email" v-model="email" class="w-full border border-gray-300 rounded-sm px-4 py-3 outline-none transition-colors duration-150 ease-in-out focus:border-blue-800" placeholder="Your email address" value="" required />
      </div>
      <div class="my-6">
            <input type="password" name="password" v-model="password" class="w-full border border-gray-300 rounded-sm px-4 py-3 outline-none transition-colors duration-150 ease-in-out focus:border-blue-800" placeholder="Your password" value="" required />
      </div>
      <div class="my-6">
        <button class="inline-block rounded-sm font-medium border border-solid cursor-pointer text-center text-base py-3 px-6 text-white bg-blue-800 border-blue-800 hover:bg-blue-900 hover:border-blue-900 w-full" type="submit">
          <font-awesome-icon icon="spinner" class="animate-spin" v-show="loading"></font-awesome-icon>
          <span v-show="!loading">Log In</span> 
        </button>
      </div>
      <div class="text-right">
        <a href="#" class="text-blue-800">Forgot your password?</a>
      </div>
      <div class="mt-4">
        <p class="text-left text-gray-800">Or login with</p>
        <div class="mt-2 grid grid-cols-4 gap-6 text-black text-2xl">
          <a href="#" class="block border border-gray-600 rounded-sm flex items-center justify-center py-3 hover:border-blue-800 hover:text-blue-800">
            <font-awesome-icon :icon="['fab', 'facebook-f']" class="mx-4 text-2xl text-black hover:text-blue-800"></font-awesome-icon>
          </a>
          <a href="#" class="block border border-gray-600 rounded-sm flex items-center justify-center py-3 hover:border-blue-800 hover:text-blue-800">
            <font-awesome-icon :icon="['fab', 'google']" class="mx-4 text-2xl text-black hover:text-blue-800"></font-awesome-icon>
          </a>
          <a href="#" class="block border border-gray-600 rounded-sm flex items-center justify-center py-3 hover:border-blue-800 hover:text-blue-800">
            <font-awesome-icon :icon="['fab', 'twitter']" class="mx-4 text-2xl text-black hover:text-blue-800"></font-awesome-icon>
          </a>
          <a href="#" class="block border border-gray-600 rounded-sm flex items-center justify-center py-3 hover:border-blue-800 hover:text-blue-800">
            <font-awesome-icon :icon="['fab', 'instagram']" class="mx-4 text-2xl text-black hover:text-blue-800"></font-awesome-icon>
          </a>
        </div>
      </div>
      <div class="mt-6 border-t border-b border-gray-300">
        <div class="my-6">
          <div class="w-full flex items-center">
            <input type="checkbox" name="rememberMe" class="appearance-none w-6 h-6 border border-gray-300 rounded-md overflow-hidden outline-none cursor-pointer checked:bg-blue-800" checked=""/>
            <label class="ml-2 text-sm" for="rememberMe">Remember this device</label>
          </div>
        </div>
      </div>
      <p class="text-sm mt-6 text-left">
        By continuing you accept our
        <a href="#" class="text-blue-400">Terms of Use</a> and
        <a href="#" class="text-blue-400">Privacy Policy</a>.
      </p>
    </div>
  </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      email: "",
      password: "", 
      loading: false
    }
  },
  mounted(){
     this.$store.commit('changecurrPage', "login")
    },
  methods: {
    login(){
      this.loading = true
      this.$store.dispatch({
          type: "login",
          email: this.email,
          password: this.password
        })
        .then(()=>{
          Toast.fire('Succesfully Logged In', '', 'info')
          var to = this.$route.query.redirect || ''
          setTimeout(() => {
            window.location.assign(process.env.MIX_APP_URL + to)
          }, 1500);
        })
        .catch((err) =>{
          if (err == 'Unauthorised'){
            Swal.fire('Wrong Details', 'Check the details you provided and try again!', 'error');
            this.loading = false
          }
          else{
            Swal.fire("There's a problem", 'Check your connection and try again', 'error')
            this.loading = false
          }
        })
    }
  }

}
</script>

<style>

</style>