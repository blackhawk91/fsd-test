<template>
    <div>
        <div class="button-wrap">
            <router-link tag="button" :to="{name:'createBook'}" class="btn btn-info">Add new book</router-link>
        </div>
        <div class="row">
            <div class="col-md-9">

                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Language</th>
                        <th>Language Org</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <tr v-for="(book,index) in books.data">
                            <td>{{book.title}}</td>
                            <td>{{book.author}}</td>
                            <td>{{book.year}}</td>
                            <td>{{book.language}}</td>
                            <td>{{book.language_org}}</td>
                            <td>
                                <button @click="viewBook(book.id)" class="btn btn-info">View</button>
                            </td>
                            <td>
                                <button @click="editBook(book.id)"class="btn btn-success">Edit</button>
                            </td>
                            <td>
                                <button @click="deleteBook(book.id,index)" class="btn btn-danger">Delete</button>
                            </td>
                    </tr>
                    </tbody>
                </table>

                <vue-pagination  :pagination="books"
                                 @paginate="getBooks()"
                                 :offset="4">
                </vue-pagination>

            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                books: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                },
                offset: 4,
                searchParam: {
                    author:'',
                    yearFrom:'',
                    yearTo:'',
                }}
        },
        mounted() {
            this.getBooks();
        },
        methods: {
            getBooks() {
                axios.get(`/api/book/index?page=${this.books.current_page}`)
                    .then((response) => {
                        this.books = response.data;
                    })
            },
            viewBook(id){
                this.$router.push({name:'viewBook', params: {id:id}})
            },
            editBook(id){
                this.$router.push({name:'editBook', params:{id:id}});
            },
            deleteBook(id, index){
                axios.delete(`/api/book/destroy/${id}?token=${this.$cookie.get('token')}`)
                    .then((response) => {
                        this.books.data.splice(index,1);
                    }).catch((err) => {
                        console.log(err)
                });
            }
        }
    }
</script>

