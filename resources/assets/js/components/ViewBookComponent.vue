<template>
    <div>
        <div class="button-wrap">
            <router-link tag="button" class="btn btn-info" :to="{name:'dashboard'}">Back</router-link>
            <router-link tag="button" class="btn btn-info" :to="{name:'editBook', params:{id:id}}">Edit</router-link>
        </div>

        <div class="card" style="width: 18rem;"  v-if="book">
            <div class="card-body">
                <h5 class="card-title text-muted">Title: <strong>{{book.title}}</strong> </h5>
                <h6 class="card-subtitle mb-2 text-muted">Author: <strong>{{book.author}}</strong></h6>
                <h6 class="card-subtitle mb-2 text-muted">Language: {{book.language}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Source language: {{book.language_org}}</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
                axios.get(`/api/book/show/${this.id}?token=${this.$cookie.get('token')}`)
                    .then((response) => {
                        this.book = response.data;
                    })
            },
        }
    }
</script>
