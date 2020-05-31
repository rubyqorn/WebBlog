<template>
    <div class="col-lg-12 mt-3" id="search-articles-form">
        <div class="d-flex">
            <div class="col-lg-1">
                <button class="btn" data-toggle="collapse" data-target="#search-field" id="toggle-search-form">
                    <i class="fa fa-search text-muted"></i>
                </button>
            </div>
            <div class="col-lg-11 collapse" id="search-field">
                <form action="/dashboard/news/categories/search" method="post">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group d-flex">
                        <input type="search" class="form-control robot-font text-muted" name="searching" placeholder="News searching" autofocus>
                        <button @click.prevent="search" class="btn btn-sm btn-outline-dark robot-font text-uppercase ml-2 mt-1 h-100">
                            <small>Search</small>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped table-hover mt-4 mb-4 d-none" id="search-content">
            <thead class="bg-primary">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="article in this.articles.data">
                    <td class="font-weight-bold">{{ article.id }}</td>
                    <td class="text-muted">{{ trimString(article.title) }}</td>
                    <td class="text-muted font-weight-bold">{{ article.author.name }}</td>
                    <td class="text-muted font-weight-bold">{{ article.comments_count }}</td>
                    <td class="text-muted">{{ dateFormating(article.created_at) }}</td>
                    <td>
                        <a href="/" class="btn btn-sm btn-outline-info robot-font text-uppercase">
                            <small>Delete</small>
                        </a> 
                    </td>
                    <td>
                       <a href="/" class="btn btn-sm btn-outline-primary robot-font text-uppercase">
                            <small>Edit</small>
                        </a> 
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-primary">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="col-lg-12 p-3 row justify-content-end" id="articles-table-pagination">
            <pagination :data="this.articles" @pagination-change-page="this.getArticles"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf'
        ],

        data: function() {
            return {
                articles: {}
            }
        },

        methods: {
            trimString(str) {
                let trimed = str.slice(0,50);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            getArticles(url, data) {
                this.$http.post(url, data).then(response => {
                    this.articles = response.data;
                })
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-articles-form input[name="_token"]'
                    ).value,
                    title: document.querySelector(
                        '#dashboard #search-articles-form input[name="searching"]'
                    ).value 
                };

                this.getArticles('/dashboard/articles/search', data);

                this.hideArticlesTable();
                this.hideArticlesTablePagination();
                this.showSearchedArticles();

            },

            hideArticlesTable() {
                return document.querySelector('#dashboard #articles-table #table').remove()
            },

            hideArticlesTablePagination() {
                return document.querySelector('#dashboard #articles-table #articles-table-pagination').remove();
            },

            showSearchedArticles() {
                return document.querySelector('#dashboard #search-articles-form #search-content')
                    .classList
                    .remove('d-none');
            }
        }

    }
</script>