<template>
  <div class="fixed md:sticky bottom-0 md:top-0 w-full md:h-screen bg-white md:bg-blue-800 text-black md:text-white border-t z-10 transition-width ease-in" :class="shrinkNav? 'md:w-24 flex flex-col items-center' : 'md:w-72'">
      <a href="#" class="hidden md:block no-underline w-40 my-6 text-2xl px-8">XCHEQUER</a>
      <div class="hidden md:flex px-8 py-6 items-center">
        <div class="relative rounded-full w-12 h-12">
            <img src="/img/kyrian.png" class="absolute left-0 top-0 w-full h-full rounded-full object-cover"/>
        </div>
        <div class="flex-1 ml-4" :class="shrinkNav? 'hidden' : 'static'">
            <p class="font-medium leading-none">{{user.first_name }} {{user.last_name}}</p>
            <a href="javascript:void(0)" @click="openSubPage('ProfileSettings')" class="no-underline text-xs text-gray-300 leading-none">Edit Profile</a>
        </div>
      </div>
      <div class="grid grid-cols-4 md:grid-cols-1">
        <router-link to="/" class="no-underline w-full px-2 md:px-8 py-3 border-l-4 text-sm transition-colors duration-200 ease-in-out" :class="currPage=='dashboard'? activeClasses : normalClasses">
          <div class="flex flex-col md:flex-row items-center">
              <font-awesome-icon icon="home" size="lg"></font-awesome-icon>
              <span :class="shrinkNav?'hidden':'static' + ' md:px-4'">Home</span>
          </div>
        </router-link>
        <router-link to="/investment" class="no-underline w-full px-2 md:px-8 py-3 border-l-4 text-sm transition-colors duration-200 ease-in-out " :class="currPage=='invest'? activeClasses : normalClasses">
          <div  class="flex flex-col md:flex-row items-center">
            <font-awesome-icon icon="rocket"  size="lg"></font-awesome-icon>
            <span :class="shrinkNav?'hidden':'static' + ' md:px-4'">Invest</span>
          </div>
        </router-link>
        <router-link to="/notifications" class="no-underline w-full px-2 md:px-8 py-3 border-l-4 text-sm transition-colors duration-200 ease-in-out" :class="currPage=='notifications'? activeClasses : normalClasses">
          <div class="flex flex-col md:flex-row items-center">
            <font-awesome-icon icon="bell"  size="lg"></font-awesome-icon>
            <span :class="shrinkNav?'hidden':'static' + ' md:px-4'">Notifications</span>
          </div>
        </router-link>
        <router-link to="/account" class="no-underline w-full px-2 md:px-8 py-3 border-l-4 text-sm transition-colors duration-200 ease-in-out" :class="currPage=='account'? activeClasses : normalClasses">
          <div class="flex flex-col md:flex-row items-center">
            <font-awesome-icon icon="user" size="lg"></font-awesome-icon>
            <span :class="shrinkNav?'hidden':'static' + ' md:px-4'">Account</span>
          </div>
        </router-link>
      </div>
    </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHome, faChartLine, faBell, faUser, faQuestionCircle, faCreditCard, faPhone, faPenSquare, faSignOutAlt, faTimes, faLock, faAngleLeft, faRocket, faWallet, faUserFriends, faSpinner, faArrowDown, faArrowUp, faCheckCircle, faTimesCircle } from '@fortawesome/free-solid-svg-icons'
import { faFacebook, faFacebookF, faGoogle, faInstagram, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
 
library.add(faHome, faChartLine, faBell, faUser, faQuestionCircle, faCreditCard, faPhone, faPenSquare, faSignOutAlt, faTimes, faLock, faFacebookF,faWhatsapp, faGoogle, faTwitter, faInstagram, faFacebook, faAngleLeft, faRocket, faWallet, faUserFriends, faSpinner, faArrowDown, faArrowUp, faCheckCircle, faTimesCircle)


export default {
  data(){
    return {
      normalClasses: "text-gray-500 md:text-white hover:text-blue-900 md:hover:text-white md:hover:border-blue-400 md:hover:bg-blue-900 border-transparent",
      activeClasses: "text-blue-900 md:text-white md:border-blue-400 md:bg-blue-900 border-transparent",
      shrinkNav: false
    }
  },
  computed: {
    currPage(){
      return this.$store.state.currPage
    },
    user(){
      return this.$store.state.user
    }
  } 
}
</script>

<style>

</style>