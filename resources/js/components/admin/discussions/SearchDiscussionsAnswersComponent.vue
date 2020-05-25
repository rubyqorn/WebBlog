<template>
    <div class="col-lg-12 mt-3" id="search-discussions-answers-form">
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

        <table class="table mt-4 table-striped table-hover" id="search-content">
            <thead class="bg-violet">
                <tr class="robot-font font-weight-bold text-white">
                    <td>#</td>
                    <td>Answer</td>
                    <td>Author</td>
                    <td>Discussions</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="answer in this.answers.data">
                    <td class="font-weight-bold">{{ answer.id }}</td>
                    <td class="text-muted">{{ trimStr(answer.answer) }}</td>
                    <td class="text-muted font-weight-bold">{{ answer.user.name }}</td>
                    <td class="text-muted">{{ trimStr(answer.discussion.title) }}</td>
                    <td class="text-muted">{{ dateFormating(answer.created_at) }}</td>
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
            <tfoot class="bg-violet">
                <tr class="robot-font font-weight-bold text-white">
                    <td>#</td>
                    <td>Answer</td>
                    <td>Author</td>
                    <td>Discussions</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="row justify-content-end p-3">
            <pagination :data="this.answers" @pagination-change-page="this.getAnswers"></pagination>
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
                answers: {}
            }
        },

        methods: {
            trimStr(str) {
                let trimed = str.slice(0,50);
                return trimed += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            getAnswers(url, data) {
                return this.$http.post(url, data).then(response => {
                    this.answers = response.data;
                })
            },

            search() {
                let data = {
                    _token: document.querySelector(
                        '#dashboard #search-discussions-answers-form input[name="_token"]'
                    ).value,
                    answer: document.querySelector(
                        '#dashboard #search-discussions-answers-form input[name="searching"]'
                    ).value
                };
                
                this.getAnswers('/dashboard/discussions/answers/search', data);

                this.hideAnswersTable();
                this.hideAnswersPagination();
                this.showResult();
            },

            hideAnswersTable() {
                return document.querySelector(
                    '#dashboard #discussions-answers #table'
                ).remove();
            },

            hideAnswersPagination() {
                return document.querySelector(
                    '#dashboard #discussions-answers #discussions-answers-pagination'
                ).remove();
            },

            showResult() {
                return document.querySelector(
                    '#dashboard #search-discussions-answers-form #search-content'
                ).classList
                 .remove('d-none');
            }
        }
    }
</script>