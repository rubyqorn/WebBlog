<template>
    <div class="col-lg-12 mt-4 p-4 mb-4 rounded bg-white shadow" id="news-comments">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># News comments table</span>
            </div>
            <div class="col-lg-6 pb-3 text-right justify-content-end">
                <a class="btn btn-sm btn-dark text-uppercase text-white robot-font">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table mt-4 table-striped table-hover" id="table">
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
                        <a href="/" class="btn btn-sm btn-outline-danger text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-sm btn-outline-success text-uppercase robot-font">
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

        <div class="row justify-content-end p-3" id="news-comments-pagination">
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
            this.getComments();
        },
        methods: {
            getComments(page = 1) {
                this.$http.get('/dashboard/news/json-comments?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.comments = data;
                    })
            },
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },
            trimStr(str) {
                let trimed = str.slice(0, 50);
                return trimed += '...'
            }
        }
    }
</script>