<template>
  <vue-final-modal v-model="open" :clickToClose="false" classes="flex-1  bg-white w-full sm:w-2/3 md:w-1/2 mx-auto md:my-4 overflow-y-auto" transition="sub-page" overlayTransition="overlay">
    <div class="w-full py-8 px-4 bg-white flex items-center text-gray-500 ">
      <font-awesome-icon icon="angle-left" @click="back" class="text-2xl cursor-pointer"></font-awesome-icon>
        <h2 class="text-2xl font-semi-bold pl-6 lg:pl-0">Contact Us</h2>
    </div>
    <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
      <div class="mt-12">
        <div class="flex items-center justify-start text-lg text-gray-500 border border-green-500 hover:text-gray-900 bg-none  h-16 rounded-md cursor-pointer my-4">
            <font-awesome-icon :icon="['fab', 'whatsapp']" class="mx-4 text-4xl text-green-500"></font-awesome-icon>
            <p>09038473928</p>
        </div>
        <div class="flex items-center justify-start text-lg text-gray-500 border border-red-500 hover:text-gray-900 bg-none  h-16 rounded-md cursor-pointer my-4">
            <font-awesome-icon :icon="['fab', 'google']" class="mx-4 text-4xl text-red-500"></font-awesome-icon>
            <p>contact@xchequerglobal.com</p>
        </div>
        <div class="flex items-center justify-start text-lg text-gray-500 border border-yellow-700 hover:text-gray-900 bg-none  h-16 rounded-md cursor-pointer my-4">
            <font-awesome-icon :icon="['fab', 'instagram']" class="mx-4 text-4xl text-yellow-700"></font-awesome-icon>
            <p>Instagram Page</p>
        </div>
        <div class="flex items-center justify-start text-lg text-gray-500 border border-blue-500 hover:text-gray-900 bg-none  h-16 rounded-md cursor-pointer my-4">
            <font-awesome-icon :icon="['fab', 'twitter']" class="mx-4 text-4xl text-blue-500"></font-awesome-icon>
            <p>Twitter Page</p>
        </div>
        <div class="flex items-center justify-start text-lg text-gray-500 border border-blue-800 hover:text-gray-900 bg-none  h-16 rounded-md cursor-pointer my-4">
            <font-awesome-icon :icon="['fab', 'facebook']" class="mx-4 text-4xl text-blue-800"></font-awesome-icon>
            <p>Facebook Page</p>
        </div>
        <div class="flex items-center justify-center text-lg text-red-500 border border-red-500 hover:text-red-600 hover:border-red-600 bg-none h-16 rounded-md cursor-pointer mt-12" @click="back">
          <p>CLOSE</p>
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
