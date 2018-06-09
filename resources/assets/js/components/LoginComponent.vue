<template>
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-6 is-offset-3">
                <h3 class="title has-text-grey">Login</h3>
                <p class="subtitle has-text-grey">Favor autenticar para prosseguir.</p>
                <div class="box">
                    <form v-on:submit.prevent>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input is-large" v-model="credentials.email" v-bind:class="{ 'is-danger': hasErrors }" type="email" autofocus="">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                            </p>
                        </div>

                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input is-large" v-model="credentials.password" v-bind:class="{ 'is-danger': hasErrors }" type="password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <p class="help is-danger is-size-5" v-show="hasErrors">Usuário ou senha incorretos</p>
                        <button @click="login()" class="button is-block is-info is-large is-fullwidth" :disabled="submitting">Login</button>
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
                hasErrors: false,
                submitting: false,
            };
        },
        methods: {
            login() {
                const vm = this;
                vm.submitting = true;
                axios.post('/login', this.credentials)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        vm.hasErrors = true;
                        vm.submitting = false;
                    });

            }
        }
    }
</script>
