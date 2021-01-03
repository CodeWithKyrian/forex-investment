<template>
  <div class="flex">
        <navigation v-if="!isLoginPage"></navigation>
        <div class="flex-1 min-h-screen bg-white">
          <app-header v-if="!isLoginPage"></app-header>
          <router-view></router-view>
        </div>
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue';
import Navigation from './components/Navigation.vue';

export default {
  name: "App",
  components: {
    Navigation, AppHeader
  },
  computed: {
    isLoginPage(){
      return this.$store.state.currPage == 'login'
    }
  },
  beforeCreate() {
    if(this.$store.getters.isAuthenticated)
    {
       this.$store.dispatch("loadUser")
       .catch((err)=>{
          window.location.assign(process.env.MIX_APP_URL + '/login')
       })
    }
  }
};
</script>
 <style>
  .sub-page-enter-active,
  .sub-page-leave-active {
    transition: transform .3s, opacity .3s;
  }
  .sub-page-enter,
  .sub-page-leave-to {
    transform: translateX(500px);
    opacity: 0;
  }
  .overlay-enter-active,
  .overlay-leave-active {
    transition: opacity .3s;
  }
  .overlay-enter,
  .overlay-leave-to {
    opacity: 0;
  }
  .confirm-modal-enter-active,
  .confirm-modal-leave-active {
    transition: transform .5s cubic-bezier(.68,-0.55,.27,1.55), opacity .5s;
  }
  .confirm-modal-enter,
  .confirm-modal-leave-to {
    transform: scale(0.1);
    opacity: 0;
  }
 </style>