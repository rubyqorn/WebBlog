<template>
    <div class="col-lg-12 bg-white shadow rounded p-4 mt-4 mb-4" id="news-table">
        <div class="col-lg-12 border-bottom row">
            <div class="col-lg-6 robot-font text-info">
                <span># List of last news</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/dashboard" class="btn btn-sm btn-info mb-3 text-uppercase font-weight-bold">
                    <small>Create</small>
                </a>
            </div>
        </div>
        
        <table class="mt-4 table table-responsive table-striped table-hover">
            <thead class="bg-info robot-font text-white">
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th>Title</th>
                    <th>Comments number</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="news in this.news.data">
                    <td class="font-weight-bold">{{ news.id }}</td>
                    <td class="text-muted">{{ trimString(news.title) }}</td>
                    <td class="text-muted">{{ news.author.name }}</td>
                    <td class="text-muted font-weight-bold">{{ news.comments_count }}</td>
                    <td class="text-muted font-weight-bold">{{ dateFormating(news.created_at) }}</td>
                    <td>
                        <a href="/" class="btn btn-outline-info btn-sm text-uppercase">
                            <small>Edit</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-outline-primary btn-sm text-uppercase">
                            <small>Update</small>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

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