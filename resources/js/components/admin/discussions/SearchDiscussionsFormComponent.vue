<template>
    <div class="col-lg-12 mt-3" id="search-discussions-form">
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
                    <td>Answers</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="discussion in this.discussions.data">
                    <td class="font-weight-bold">{{ discussion.id }}</td>
                    <td class="text-muted">{{ trimString(discussion.title) }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.authors.name }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.answers_count }}</td>
                    <td class="text-muted">{{ dateFormating(discussion.created_at) }}</td>
                    <td>
                        <a href="#" data-toggle="modal" :data-target="'#delete-'+discussion.id" class="btn btn-sm btn-outline-info robot-font text-uppercase">
                            <small>Delete</small>
                        </a> 
                    </td>
                    <td>
                       <a :href="'/dashboard/discussions/'+discussion.id+'/edit'" class="btn btn-sm btn-outline-primary robot-font text-uppercase">
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
                    <td>Answers</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="modal fade show" :id="'delete-'+discussion.id" v-for="discussion in this.discussions.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ discussion.id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ discussion.id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/discussions/'+discussion.id+'/delete'" method="post" id="delete-discussions">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteDiscussion" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end p-3" id="discussions-pagination">
            <pagination :data="this.discussions" @pagination-change-page="this.getDiscussions"></pagination>
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
                discussions: {},
                response: {}
            }
        },

        methods: {
            getDiscussions(url, data) {
                this.$http.post(url, data).then(response => {
                    this.discussions = response.data
                });
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-discussions-form input[name="_token"]'
                    ).value,
                    title: document.querySelector(
                        '#dashboard #search-discussions-form input[name="searching"]'
                    ).value
                };

                this.getDiscussions('/dashboard/discussions/search', data);

                this.hideDiscussionsPagination();
                this.hideDiscussionsTable();
                this.showResult();
            },

            trimString(str) {
                let trimed = str.slice(0,30);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            hideDiscussionsTable() {
                return document.querySelector(
                    '#dashboard #discussions-table #table'
                ).remove();
            },

            hideDiscussionsPagination() {
                return document.querySelector(
                    '#dashboard #discussions-table #discussions-pagination'
                ).remove();
            },

            showResult() {
                return document.querySelector(
                    '#dashboard #search-discussions-form #search-content'
                ).classList
                 .remove('d-none');
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            deleteDiscussion() {
                let uri = document.querySelector(
                    '#dashboard #discussions-table #delete-discussions'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #discussions-table .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            } 
        }
    }
</script>