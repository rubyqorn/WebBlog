<template>
    <div class="col-lg-12 rounded shadow bg-white p-4 mt-4 mb-4" id="articles-comments">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># Articles comments table</span>
            </div>
        </div>

        <slot></slot>

        <table class="table table-striped table-hover mt-4" id="table">
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
                    <td class="text-muted font-weight-bold">{{ comment.user.name }}</td>
                    <td class="text-muted">{{ trimStr(comment.article.title) }}</td>
                    <td class="text-muted">{{ dateFormating(comment.created_at) }}</td>
                    <td>
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+comment.id" class="btn btn-sm btn-outline-secondary text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/articles/comments/'+comment.id+'/edit'" class="btn btn-sm btn-outline-dark text-uppercase robot-font">
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

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>

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
                        <form :action="'/dashboard/articles/comments/'+comment.id+'/delete'" method="post" id="delete-articles-comments">
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

        <div class="col-lg-12 p-3 row justify-content-end" id="articles-comments-pagination">
            <pagination :data="this.comments" @pagination-change-page="this.getComments"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                comments: {},
                response: {},
                message: null
            }
        },
        created() {
            this.getComments()
        },
        methods: {
            getComments(page = 1) {
                this.$http.get('/dashboard/articles/json-comments?page='+ page)
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        this.comments = data;
                    })
            },

            trimStr(str) {
                let trimed = str.slice(0,30);
                return str += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                });
            },

            deleteComment() {
                let uri = document.querySelector(
                    '#dashboard #articles-comments #delete-articles-comments'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #articles-comments .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>