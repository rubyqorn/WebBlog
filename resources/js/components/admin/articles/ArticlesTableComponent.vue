<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="articles-table">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># Articles table</span>
            </div>
            <div class="col-lg-6 justify-content-end text-right">
                <a href="/dashboard/articles/create" class="mb-3 btn btn-sm btn-info text-white text-uppercase robot-font">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table table-striped table-hover mt-4 mb-4" id="table">
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
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+article.id" class="btn btn-sm btn-outline-info robot-font text-uppercase">
                            <small>Delete</small>
                        </a> 
                    </td>
                    <td>
                       <a :href="'/dashboard/articles/'+article.id+'/edit'" class="btn btn-sm btn-outline-primary robot-font text-uppercase">
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

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>

        <div class="modal fade show" :id="'delete-'+article.id" v-for="article in this.articles.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ article.id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ article.id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/articles/'+article.id+'/delete'" method="post" id="delete-articles">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteArticle" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 p-3 row justify-content-end" id="articles-table-pagination">
            <pagination :data="this.articles" @pagination-change-page="this.getArticles"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                articles: {},
                response: {},
                message: null
            }
        },
        created() {
            this.getArticles();
        },
        methods: {
            getArticles(page = 1) {
                this.$http.get('/dashboard/articles/json-articles?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.articles = data;
                    });
            },

            trimString(str) {
                let trimed = str.slice(0, 30);
                return str += '...';
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

            deleteArticle() {
                let uri = document.querySelector(
                    '#dashboard #articles-table #delete-articles'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #articles-table .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>