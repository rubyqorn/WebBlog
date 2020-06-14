<template>
    <div class="col-lg-12 mt-3" id="search-news-form">
        <div class="d-flex">
            <div class="col-lg-1">
                <button class="btn" data-toggle="collapse" data-target="#search-field" id="toggle-search-form">
                    <i class="fa fa-search text-muted"></i>
                </button>
            </div>
            <div class="col-lg-11 collapse" id="search-field">
                <form action="/dashboard/news/search" method="post">
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
        <table class="table table-hover table-striped mt-4 d-none" id="search-content">
            <thead class="bg-dark font-weight-bold">
                <tr class="robot-font text-white">
                    <td>#</td>
                    <td>Title</td>
                    <td>Category</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody class="robot-font">
                <tr v-for="news in this.news.data">
                    <td class="font-weight-bold">{{ news.id }}</td>
                    <td class="text-muted">{{ trimString(news.title )}}</td>
                    <td class="text-muted font-weight-bold">{{ news.category.name }}</td>
                    <td class="text-muted font-weight-bold">{{ news.comments_count }}</td>
                    <td class="text-muted">{{ dateFormating(news.created_at) }}</td>
                    <td>
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+news.id" class="btn btn-sm btn-outline-info text-uppercase robot-font" :id="news.id">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/news/'+news.id+'/edit'" class="btn btn-sm btn-sm btn-outline-primary text-uppercase robot-font">
                            <small>Edit</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-dark font-weight-bold">
                <tr class="robot-font text-white">
                    <td>#</td>
                    <td>Title</td>
                    <td>Category</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="modal fade show" :id="'delete-'+news.id" v-for="news in this.news.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ news.id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ news.id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/news/'+news.id+'/delete'" method="post" id="delete-news">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteNews" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4 mb-3 row justify-content-end" id="search-news-pagination">
            <pagination :data="this.data" @pagination-change-page="this.searchNews"></pagination>
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
                news: {},
                response: {}
            }
        },
        methods: {
            searchNews(url, data) {
                this.$http.post(url, data).then(response => {
                    this.news = response.data;
                });
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-news-form input[name="_token"]'
                    ).value,
                    title: document.querySelector(
                        '#search-news-form input[name="searching"]'
                    ).value
                }

                this.searchNews('/dashboard/news/search', data);

                this.hideMainNewsTable();
                this.hideNewsPagination();
                this.showSearchNewsTable();

            },

            hideMainNewsTable() {
                return document.querySelector('#dashboard #news-table #table').remove();
            },

            hideNewsPagination() {
                return document.querySelector('#dashboard #news-table #news-pagination').remove();
            },

            showSearchNewsTable() {
                 return document.querySelector('#dashboard #search-news-form #search-content')
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

            deleteNews() {
                let uri = document.querySelector(
                    '#dashboard #news-table #delete-news'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #news-table .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>