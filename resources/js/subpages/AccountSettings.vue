<template>
  <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1  bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto" transition="sub-page" overlayTransition="overlay">
    <div class="w-full py-8 px-4 bg-white flex items-center text-gray-500 ">
      <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
        <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">Account Settings</h2>
    </div>
    <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
      <div class="mt-12">
          <large-button icon="user" text="Profile Setting" @click.native="$router.push({name: 'profile'})"></large-button>
          <large-button icon="lock" text="Password Setting" @click.native="$router.push({name: 'password'})"></large-button>
          <div class="flex items-center justify-center text-lg text-red-500 border border-red-500 hover:text-red-600 hover:border-red-600 bg-none h-16 rounded-md cursor-pointer mt-12" @click="back">
              <p>CANCEL</p>
          </div>
      </div>
    </div>
  </vue-final-modal>
</template>

<script>
import LargeButton from '../blocks/LargeButton.vue';
export default {
  data: () => ({
    open: true,
  }),
  components: {
    LargeButton
  },
  methods: {
    back(){
      this.open = false;
      setTimeout(() => {
        this.$router.push('/account')
      }, 500);
    }
  }
}
</script>


<style scoped>
</style>
