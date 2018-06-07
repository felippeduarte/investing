<template>
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-6 is-offset-3">
                <h3 class="title has-text-grey">Login</h3>
                <p class="subtitle has-text-grey">Please login to proceed.</p>
                <div class="box">
                    <form v-on:submit.prevent>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="credentials.email" type="email" placeholder="Your Email" autofocus="">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="credentials.password" type="password" placeholder="Your Password">
                            </div>
                        </div>
                        <button @click="login()" class="button is-block is-info is-large is-fullwidth">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                credentials: {
                    email: '',
                    password: ''
                },
            };
        },
        methods: {
            login() {
                axios.post('/login', this.credentials)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>
