<template>
        <div v-if="book">
            <div class="page-content">
                <div class="form-wrap">

                    <form @submit.prevent="validateBeforeSubmit">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" v-validate="'required|max:255'" v-model="book.title" placeholder="Enter title">
                            <small id="emailHelp" class="form-text text-muted" v-show="errors.has('title')">{{ errors.first('title') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input class="form-control"  type="text" name="author" id="author" v-validate="'required|max:40'" v-model="book.author" placeholder="Enter author">
                            <small id="emailHelp" class="form-text text-muted" v-show="errors.has('author')">{{ errors.first('author') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input class="form-control" type="number" name="year" id="year" v-validate="'required|integer'" v-model="book.year" placeholder="Enter year">
                            <small id="emailHelp" class="form-text text-muted" v-show="errors.has('year')">{{ errors.first('year') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="language">Language</label>
                            <input class="form-control" name="language" id="language" v-validate="'required|max:255'" v-model="book.language" placeholder="Enter language">
                            <small id="emailHelp" class="form-text text-muted" v-show="errors.has('language')">{{ errors.first('language') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="language_org">Language org</label>
                            <input class="form-control" type="language_org" name="language_org" id="language_org" v-validate="'required|max:255'" v-model="book.language_org" placeholder="Enter language org">
                            <small id="emailHelp" class="form-text text-muted" v-show="errors.has('language_org')">{{ errors.first('language_org') }}</small>
                        </div>

                        <div class="btn-wrap">
                            <router-link tag="a" class="btn btn-info" :to="{name:'dashboard'}">Back</router-link>

                            <button type="submit" class="btn btn-info ">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
</template>

<script>
    export default {
        created(){
            this.id = this.$route.params.id;
        },
        data() {
            return {
                id:null,
                book:null
            }
        },
        mounted() {
            this.getBook();
        },
        methods: {
            getBook() {
                axios.get(`/api/book/${this.id}/edit?token=${this.$cookie.get('token')}`)
                    .then((response) => {
                        this.book = response.data;
                    })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.update();
                    }
                });
            },
            update(){
                axios.put(`/api/book/update?token${this.$cookie.get('token')}`, this.book).then((res) => {
                    this.$router.push({name:'dashboard'})
                }).catch((err)=> {
                    console.log(err);
                })
            }
        }
    }
</script>
