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
                        <a href="/" class="btn btn-sm btn-outline-secondary text-uppercase robot-font">
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

        <div class="col-lg-12 p-3 row justify-content-end" id="articles-comments-pagination">
            <pagination :data="this.comments" @pagination-change-page="this.getComments"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                comments: {}
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
                let trimed = str.slice(0,50);
                return str += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            }
        }
    }
</script>