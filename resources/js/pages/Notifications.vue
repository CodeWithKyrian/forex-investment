<template>
    <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
      <!-- <div class="w-full sm:w-2/3 md:w-1/2 my-4 mx-auto"> -->
      <div class="grid .grid-cols-1 gap-4 md:grid-cols-2 md:gap-8">
          <notification
           v-for="notification in notifications" 
           :key="notification.title"
           :title="notification.title"
           :content="notification.content"
           :date="notification.date">
           </notification>
      </div>
    </div>
</template>

<script>
import Notification from '../blocks/Notification.vue'
export default {
  mounted(){
    this.$store.commit('changecurrPage', "notifications")
  },
  components: {Notification},
  data(){
    return {
      notifications: [
        {
          title: "Payment Alert",
          content: "The requested amount of N200, 000 has been succesfully transferred to your bank account. Thanks once more for choosing to invest with us",
          date: "25th January, 2020 - 12:24PM"
        },
        {
          title: "Account Verified",
          content: "This is to notify you that your account has been succesfully verified. You can now proceed with placing a withdrawal request.",
          date: "8th October, 2020 - 16:10PM"
        },
        {
          title: "Black Friday Promo",
          content: "Commit a new investment before the end of the month and stand the chance of winning 50% of your investment amount. The clock is ticking.",
          date: "24th November, 2020 - 5:15AM"
        },
        {
          title: "Merry Christmas",
          content: "It is finally that time of the year. Merry Christmas Kyrian. We pray the upcoming year will be fruitful and prosperous for you and your family.",
          date: "25th December, 2020 - 9:00AM"
        }
      ]
    }
  }
}
</script>

<style>

</style>