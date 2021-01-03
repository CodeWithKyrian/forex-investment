<template>
  <div>
    <section>
        <h1>Make Fake Payment</h1>
        <div class="formcontainer">
            <hr />
            <div class="container">
                <div class="form-group">
                    <input v-model="full_name" required type="text" placeholder="Enter your name" name="uname" class="form-control"/>
                </div>
                <div class="form-group">
                    <input v-model="email" required type="text" placeholder="Enter your email" name="email" class="form-control"/>
                </div>
                <div class="form-group">
                    <input v-model="amount" type="tel" placeholder="1000" name="amount" required class="form-control"/>
                </div>
                <div class="form-group">
                    <paystack
                        :amount="amount * 100"
                        :email="email"
                        :paystackkey="PUBLIC_KEY"
                        :reference="reference"
                        :callback="processPayment"
                        :close="close"
                        class="btn btn-primary"
                    >
                        Make Payment
                    </paystack>
                </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script>
    import paystack from 'vue-paystack'
    export default {
        name: "App",
        components: {paystack},
        data(){
            return {
                amount: 0,
                full_name: '',
                email: '',
                PUBLIC_KEY: 'pk_test_d47771c38b5d2c20a35b7c2c8513d4429aa4a6a0'
            }
        },
        computed: {
            reference() {
                let text = "";
                let possible =
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (let i = 0; i < 10; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                return text;
            }
        },
        methods: {
            processPayment: () => {
                window.alert("Payment recieved")
            },
            close: () => {
                console.log("You closed checkout page")
            }
        },
    }
</script>

<style>

</style>