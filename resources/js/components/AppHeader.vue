<template>
  <div class="w-full py-6 px-4 bg-white shadow-sm flex justify-between items-center">
      <h2 class="text-2xl font-bold text-blue-800 pl-4 lg:pl-0">{{headerTxt}}</h2>
      <div class="flex items-center">
        <font-awesome-icon icon="question-circle" class="cursor-pointer ml-4"></font-awesome-icon>
      </div>
    </div>
</template>

<script>
export default {
  computed: {
    currPage(){
      return this.$store.state.currPage
    }, 
    headerTxt(){
      switch (this.currPage) {
        case "account":
          return "My Account";
          break;
        case "notifications":
          return "My Notifications";
          break;
        case "invest":
          return "Investment";
          break;
        default:
          return "Welcome back, Kyrian"
          break;
      }
    }
  },
  methods: {
    openSubPage(subPage){
      Fire.$emit("open"+subPage)
    }
  } 
}
</script>

<style>

</style>