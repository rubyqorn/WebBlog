<template>
    <div class="col-lg-12 mt-3" id="search-articles-categories-form">
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

        <table class="table table-striped table-hover table-border mt-4 d-none" id="search-content">
            <thead class="text-white bg-warning font-weight-bold robot-font">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in this.categories.data">
                    <td class="font-weight-bold">{{ category.category_id }}</td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ category.name }}
                    </td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ category.color }}
                    </td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ dateFormating(category.created_at) }}
                    </td>
                    <td>
                        <a href="/" class="btn btn-outline-secondary btn-sm text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-outline-dark btn-sm text-uppercase robot-font">
                            <small>Update</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="text-white bg-warning font-weight-bold robot-font">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </tfoot>
        </table>

        <div class="row justify-content-end p-3" id="articles-categories-pagination">
            <pagination :data="this.categories" @pagination-change-page="this.getCategories"></pagination>
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
                categories: {}
            }
        },
        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            getCategories(url, data) {
                this.$http.post(url, data).then(response => {
                    this.categories = response.data;
                })
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-articles-categories-form input[name="_token"]'
                    ).value,
                    name: document.querySelector(
                        '#dashboard #search-articles-categories-form input[name="searching"]'
                    ).value
                };

                this.getCategories('/dashboard/articles/categories/search', data);

                this.hideArticlesTable();
                this.hideArticlesPagination();
                this.showSearchedArticles();

            },

            hideArticlesTable() {
                return document.querySelector(
                    '#dashboard #articles-categories #table'
                ).remove();
            },

            hideArticlesPagination() {
                return document.querySelector(
                    '#dashboard #articles-categories #articles-categories-pagination'
                ).remove();
            },

            showSearchedArticles() {
                return document.querySelector(
                    '#dashboard #search-articles-categories-form #search-content'
                ).classList
                 .remove('d-none');
            }
        }
    }
</script>