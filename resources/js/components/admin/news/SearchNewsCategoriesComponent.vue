<template>
    <div class="col-lg-12 mt-3" id="search-news-categories-form">
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
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+category.category_id" class="btn btn-outline-secondary btn-sm text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/news/categories/'+category.category_id+'/edit'" class="btn btn-outline-dark btn-sm text-uppercase robot-font">
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

        <div class="modal fade show" :id="'delete-'+category.category_id" v-for="category in this.categories.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ category.category_id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ category.category_id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/news/categories/'+category.category_id+'/delete'" method="post" id="delete-news-category">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteCategory" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end p-3" id="news-categories-pagination">
            <pagination :data="this.categories" @pagination-change-page="this.searchCategories"></pagination>
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
                categories: {},
                response: {}
            }
        },
        methods: {
            searchCategories(url, data) {
                this.$http.post(url, data).then(response => {
                    this.categories = response.data;
                })
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-news-categories-form input[name="_token"]'
                    ).value,
                    name: document.querySelector(
                        '#dashboard #search-news-categories-form input[name="searching"]'
                    ).value
                }

                this.searchCategories('/dashboard/news/categories/search', data);

                this.hideMainCategoriesTable();
                this.hideCategoriesPagination();
                this.showSearchCategoriesTable();
            },

            hideMainCategoriesTable() {
                return document.querySelector('#dashboard #news-categories-table #table').remove();
            },

            hideCategoriesPagination() {
                return document.querySelector('#dashboard #news-categories-table #news-categories-pagination').remove();
            },

            showSearchCategoriesTable() {
                 return document.querySelector('#dashboard #search-news-categories-form #search-content')
                    .classList
                    .remove('d-none');
            },

            trimString(str) {
                let trimed = str.slice(0, 30);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            deleteCategory() {
                let uri = document.querySelector(
                    '#dashboard #news-categories-table #delete-news-category'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #news-categories-table .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>