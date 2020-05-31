<template>
    <div class="col-lg-12 bg-white shadow rounded mt-4 mb-4 p-4" id="news-table">
         <div class="col-lg-12 border-bottom row">
            <div class="col-lg-6 robot-font text-info">
                <span># News table</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/dashboard" class="btn btn-sm btn-info mb-3 text-uppercase font-weight-bold">
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
                        <a href="/" class="btn btn-sm btn-outline-info text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-sm btn-sm btn-outline-primary text-uppercase robot-font">
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
        <div class="row justify-content-end p-4" id="news-pagination">
            <pagination :data="this.news" @pagination-change-page="this.getNews"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                news: {}
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
                let trimed = str.slice(0, 50);
                return trimed += '...'
            }
        }
    }
</script>