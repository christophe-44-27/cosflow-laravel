<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuesax Admin - VueJS Dashboard Admin Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row no-gutter justify-center items-center">
                        <div class="vx-col hidden lg:block lg:w-1/2">
                            <img src="@assets/images/pages/login.png" alt="login" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                            <div class="p-8">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">Create Account</h4>
                                    <p>Fill the below form to create a new account.</p>
                                </div>
                                <vs-input
                                    name="name"
                                    icon="icon icon-user"
                                    icon-pack="feather"
                                    label-placeholder="Pseudonyme"
                                    v-model="name"
                                    class="w-full no-icon-border"/>

                                <vs-input
                                    name="email"
                                    icon="icon icon-user"
                                    icon-pack="feather"
                                    label-placeholder="Adresse courriel"
                                    v-model="email"
                                    class="w-full no-icon-border"/>

                                <vs-input
                                    type="password"
                                    name="password"
                                    icon="icon icon-lock"
                                    icon-pack="feather"
                                    label-placeholder="Password"
                                    v-model="password"
                                    class="w-full mt-6 no-icon-border" />

                                <div class="flex flex-wrap justify-between my-5">
                                    <vs-checkbox v-model="checkbox_remember_me" class="mb-3">Remember Me</vs-checkbox>
                                    <router-link to="#">Forgot Password?</router-link>
                                </div>
                                <vs-button  type="border">Register</vs-button>
                                <vs-button @click.prevent="onSubmit" class="float-right">Créer mon compte</vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                accesToken: '',
                name: '',
                email: '',
                password: '',
                checkbox_remember_me: false,
                terms: false
            }
        },
        mounted() {
            if (localStorage.accesToken) {
                this.accesToken = localStorage.accesToken;
            }
        },
        watch: {
            accesToken(newToken) {
                localStorage.accesToken = newToken;
            }
        },
        methods: {
            onSubmit() {
                const formData = {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }
                this.$store.dispatch('signup', {name: formData.name, email: formData.email, password: formData.password})
            }
        }
    }
</script>

<style lang="scss">
    #page-login {
        .social-login {
            .bg-facebook {
                background-color: #1551b1;
            }
            .bg-twitter {
                background-color: #00aaff;
            }
            .bg-google {
                background-color: #4285F4;
            }
            .bg-github {
                background-color: #333;
            }
        }
    }
</style>
