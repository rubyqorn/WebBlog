<template>
    <div class="col-lg-12 mt-3" id="search-articles-comments-form">
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

        <table class="table table-striped table-hover mt-4 d-none" id="search-content">
            <thead class="bg-secondary">
                <tr class="text-white robot-font font-weight">
                    <td>#</td>
                    <td>Comment</td>
                    <td>Author</td>
                    <td>Article</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="comment in this.comments.data">
                    <td class="font-weight-bold">{{ comment.id }}</td>
                    <td class="text-muted">{{ trimStr(comment.comment) }}</td>
                    <td class="text-muted font-weight-bold">{{ comment.users.name }}</td>
                    <td class="text-muted">{{ trimStr(comment.article.title) }}</td>
                    <td class="text-muted">{{ dateFormating(comment.created_at) }}</td>
                    <td>
                        <a href="/" class="btn btn-sm btn-outline-secondary text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-sm btn-outline-dark text-uppercase robot-font">
                            <small>Edit</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-secondary">
                <tr class="text-white robot-font font-weight">
                    <td>#</td>
                    <td>Comment</td>
                    <td>Author</td>
                    <td>Article</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="row justify-content-end p-3" id="articles-comments-pagination">
            <pagination :data="this.comments" @pagination-change-page="this.getComments"></pagination>
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
                comments: {}
            }
        },

        methods: {
            trimStr(str) {
                let trimed = str.slice(0,50);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            getComments(url, data) {
                return this.$http.post(url, data).then(response => {
                    this.comments = response.data
                });
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-articles-comments-form input[name="_token"]'
                    ).value,
                    comment: document.querySelector(
                        '#dashboard #search-articles-comments-form input[name="searching"]'
                    ).value
                };

                this.getComments('/dashboard/articles/comments/search', data);

                this.hideCategoriesTable();
                this.hideCategoriesPagination();
                this.showSearchedResult();

            },

            hideCategoriesTable() {
                return document.querySelector(
                    '#dashboard #articles-comments #table'
                ).remove();
            },

            hideCategoriesPagination() {
                return document.querySelector(
                    '#dashboard #articles-comments #articles-comments-pagination'
                ).remove();
            },

            showSearchedResult() {
                return document.querySelector(
                    '#dashboard #search-articles-comments-form #search-content'
                ).classList
                 .remove('d-none');
            }
        }
    }
</script>