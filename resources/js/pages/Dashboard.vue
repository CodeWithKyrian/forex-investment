<template>
    <div class="w-full max-w-screen-xl py-6 px-6 mb-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <dash-card title="Wallet Balance" :content="walletBalance" icon="wallet" :fill="true" color="bg-blue-800" @click.native="$router.push('/wallet')"></dash-card>
            
            <dash-card title="Total Investments" :content="totalInvestments"  icon="chart-line" @click.native="openSubPage('MyWallet')"></dash-card>

            <dash-card title="Referral Bonus" :content="referralBalance" icon="user-friends" :fill="true" color="bg-purple-800" @click.native="openSubPage('MyWallet')"></dash-card>
        </div>
    </div>
</template>

<script>
import DashCard from '../blocks/DashCard.vue';
export default {
  components: { DashCard },
    mounted() {
        this.$store.commit("changecurrPage", "dashboard");
    },
    computed: {
        user() {
            return this.$store.state.user;
        },
        walletBalance(){
            var balance =  new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(this.user.wallet_balance || 0)
            return balance
        },
        totalInvestments(){
            var balance =  new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(this.user.investment_balance || 0)
            return balance
        },
        referralBalance(){
            var balance =  new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(this.user.referral_balance || 0)
            return balance
        }
    }
};
</script>

<style></style>
