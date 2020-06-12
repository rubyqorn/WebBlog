<template>
    <div class="col-lg-12 bg-white shadow rounded mt-4 mb-4 p-4" id="news-table">
         <div class="col-lg-12 border-bottom row">
            <div class="col-lg-6 robot-font text-info">
                <span># News table</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/dashboard/news/create" class="btn btn-sm btn-info mb-3 text-uppercase font-weight-bold">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="mt-4 table table-border table-stripped table-hover" id="table">
            <thead class="bg-info text-white">
                <tr class="font-weight-bold robot-font">
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Comments</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
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
            <tfoot class="bg-info text-white">
                <tr class="font-weight-bold robot-font">
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Comments</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </tfoot>
        </table>

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>

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

        <div class="row justify-content-end p-4" id="news-pagination">
            <pagination :data="this.news" @pagination-change-page="this.getNews"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                news: {},
                message: null,
                response: {}
            }
        },

        created() {
            this.getNews();
        },

        methods: {
            getNews(page = 1) {
                this.$http.get('/json-news?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.news = data;
                    });
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            trimString(str) {
                let trimed = str.slice(0, 30);
                return trimed += '...'
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