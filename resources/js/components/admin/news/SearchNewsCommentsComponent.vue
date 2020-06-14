<template>
    <div class="col-lg-12 mt-3" id="search-news-comments-form">
        <div class="d-flex">
            <div class="col-lg-1">
                <button class="btn" data-toggle="collapse" data-target="#search-field" id="toggle-search-form">
                    <i class="fa fa-search text-muted"></i>
                </button>
            </div>
            <div class="col-lg-11 collapse" id="search-field">
                <form action="/dashboard/news/comments/search" method="post">
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

        <table class="table mt-4 table-striped table-hover d-none" id="search-content">
            <thead class="bg-dark">
                <tr class="robot-font font-weight-bold text-white">
                    <td>#</td>
                    <td>Comment</td>
                    <td>Author</td>
                    <td>News</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="comment in this.comments.data">
                    <td class="font-weight-bold">{{ comment.id }}</td>
                    <td class="text-muted">{{ trimStr(comment.comment) }}</td>
                    <td class="text-muted font-weight-bold">{{ comment.user.name }}</td>
                    <td class="text-muted">{{ trimStr(comment.news.title) }}</td>
                    <td class="text-muted">{{ dateFormating(comment.created_at) }}</td>
                    <td>
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+comment.id" class="btn btn-sm btn-outline-danger text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/news/comments/'+comment.id+'/edit'" class="btn btn-sm btn-outline-success text-uppercase robot-font">
                            <small>Edit</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-dark">
                <tr class="robot-font font-weight-bold text-white">
                    <td>#</td>
                    <td>Comment</td>
                    <td>Author</td>
                    <td>News</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="modal fade show" :id="'delete-'+comment.id" v-for="comment in this.comments.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ comment.id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ comment.id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/news/comments/'+comment.id+'/delete'" method="post" id="delete-news-comment">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteComment" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end p-3" id="news-comments-pagination">
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
                comments: {}, 
                response: {}
            }
        },
        methods: {
            trimStr(str) {
                let trimed = str.slice(0,30);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yyy');
            },

            getComments(url, data) {
                this.$http.post(url, data).then(response => {
                    this.comments = response.data;
                });
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-news-comments-form input[name="_token"]'
                    ).value,
                    comment: document.querySelector(
                        '#dashboard #search-news-comments-form input[name="searching"]'
                    ).value
                }

                this.getComments('/dashboard/news/comments/search', data);

                this.hideNewsCommentsTable();
                this.hideNewsCommentsPagination();
                this.showSearhedNewsComments();
            },

            hideNewsCommentsTable() {
                return document.querySelector('#dashboard #news-comments #table').remove();
            },

            hideNewsCommentsPagination() {
                return document.querySelector('#dashboard #news-comments #news-comments-pagination').remove();
            },

            showSearhedNewsComments() {
                return document.querySelector('#dashboard #search-news-comments-form #search-content')
                    .classList
                    .remove('d-none');
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            deleteComment() {
                let uri = document.querySelector(
                    '#dashboard #news-comments #delete-news-comment'
                ).getAttribute('action');

                this.sendRequest(uri);
                
                $('#dashboard #news-comments .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>