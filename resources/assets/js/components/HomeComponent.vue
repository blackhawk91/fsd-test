<template>
    <div class="wrap">
        <div class="row">
            <div class="col-md-3">
            <div class="aside-box">
                <div class="input-wrap">
                    <label for="name">Name of author:</label>
                    <input type="text" id="name" v-model="searchParam.author" class="form-control">
                </div>
                <div class="input-wrap">
                    <label for="price">Year from:</label>
                    <input type="text" id="price" v-model="searchParam.yearFrom" class="form-control">
                </div>
                <div class="input-wrap">
                    <label for="price">Year to:</label>
                    <input type="text" id="price" v-model="searchParam.yearTo" class="form-control">
                </div>

                <button class="btn btn-info btn-src" @click="search()">Search</button>
            </div>
        </div>
            <div class="col-md-9 mt-4" >
                <vue-pagination  :pagination="books"
                                 @paginate="getBooks()"
                                 :offset="4">
                </vue-pagination>
               <table class="table">
                   <thead>
                       <th>Title</th>
                       <th>Author</th>
                       <th>Year</th>
                       <th>Language</th>
                       <th>Language Org</th>
                   </thead>
                   <tbody>
                       <tr v-for="book in books.data">
                           <td>{{book.title}}</td>
                           <td>{{book.author}}</td>
                           <td>{{book.year}}</td>
                           <td>{{book.language}}</td>
                           <td>{{book.language_org}}</td>
                       </tr>
                   </tbody>
               </table>
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
                axios.get(`http://localhost:8000/api/book?page=${this.books.current_page}&${this.serialize()}`)
                    .then((response) => {
                        console.log(response.data)
                        this.books = response.data;
                    })
            },
            search(){
                this.books.current_page = 1;
                this.getBooks();
            },
            serialize(){
                let str = [];
                for(var p in this.searchParam)
                    if (this.searchParam.hasOwnProperty(p)) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(this.searchParam[p]));
                    }
                return str.join("&");
            }
        }
    }
</script>

<style>
    .aside-box {
        border: 1px solid gainsboro;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 2px 2px 4px rgba(0, 123, 255, 0.22);
        display: flex;
        flex-direction: column;
    }

    .input-wrap {
        margin: 5px 0;
    }

    .btn-src {
        margin: 10px 0;
    }



</style>
