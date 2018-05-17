<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" tag="a" to="/">
                Home
            </router-link>
            <router-link v-if="authenticated" :to="{name:'dashboard'}" tag="a" class="navbar-brand">Dashboard</router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    <template v-if="authenticated">
                        <li><a @click="logout()" class="nav-link">Logout</a></li>
                    </template>

                    <template v-if="!authenticated">
                        <li><router-link to="login" tag="a" class="nav-link">Login</router-link></li>
                        <li><router-link to="register" tag="a" class="nav-link">Register</router-link></li>
                    </template>

                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { EventBus } from '../event-bus.js';

    export default {
        mounted(){
            if(this.$cookie.get('token')){
                this.authenticated = true;
            } else {
                this.authenticated = false;
            }
        },
        created() {
            EventBus.$on('login', (value) => {
                this.authenticated = value;
            });
        },
        data(){
            return {
                authenticated: false
            }
        },
        methods:{
            logout(){
                axios.get(`/api/logout?token=${this.$cookie.get('token')}`).then((res)=>{
                    this.$cookie.delete('token');
                    this.authenticated = false;
                    this.$router.push('/');
                }).catch((err)=>{console.log(err)})
            }
        }
    }
</script>

