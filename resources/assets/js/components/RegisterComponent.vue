<template>

    <div class="form-wrap">

        <form @submit.prevent="validateBeforeSubmit">

            <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" v-validate="'required|max:20'" type="text" name="first_name" id="first_name" v-model="user.first_name" placeholder="Enter first name">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</small>
            </div>

            <div class="form-group">
                <label for="last_name">Last name</label>
                <input class="form-control" v-validate="'required|max:20'" type="text" name="last_name" id="last_name" v-model="user.last_name" placeholder="Enter last name">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('last_name')">{{ errors.first('last_name') }}</small>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" v-validate="'required|email'" type="text" name="email" id="email" v-model="user.email" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('email')">{{ errors.first('email') }}</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" v-validate="'required|min:6'" name="password" v-model="user.password" placeholder="Enter password">
                <small id="emailHelp" class="form-text text-muted" v-show="errors.has('password')">{{ errors.first('password') }}</small>
            </div>


            <div class="btn-wrap">
                <button type="submit" class="btn btn-info ">Register</button>
            </div>

        </form>

    </div>
</template>

<script>
    export default {
        data(){
          return {
              user:{
                  first_name:'',
                  last_name:'',
                  email:'',
                  password:''
              }
          }
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.register();
                    }
                });
            },
            register(){
                axios.post('/api/register',this.user).then((res) => {
                    this.$router.push('/login');
                }).catch((err) => {
                    console.log(err);
                })
            }
        }
    }
</script>
