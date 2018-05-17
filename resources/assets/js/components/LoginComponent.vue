<template>
    <div class="form-wrap">

        <form @submit.prevent="validateBeforeSubmit">

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input class="form-control" v-validate="'required|email'" type="text" name="email" id="exampleInputEmail1" v-model="user.email" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('email')">{{ errors.first('email') }}</small>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input class="form-control"type="password" id="password" v-validate="'required|min:6'" name="password" v-model="user.password" placeholder="Enter password">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('password')">{{ errors.first('password') }}</small>
            </div>

            <div class="btn-wrap">
                <button type="submit" class="btn btn-info ">Login</button>
            </div>

        </form>

    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js';

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data(){
            return {
                user:{
                    email:'',
                    password:''
                }
            }
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.login();
                    }
                });
            },
            login() {
                axios.post('/api/login',this.user).then((res) => {
                    this.$cookie.set('token', res.data.token,  { expires: '1h' });
                    EventBus.$emit('login', true);
                    this.$router.push('/dashboard');
                }).catch((err) => {
                    console.log(err);
                })
            }
        }
    }
</script>

