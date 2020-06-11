<template>
    <div class="col-lg-12 mt-4 p-4 mb-4 rounded bg-white shadow" id="discussions-answers">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># Discussions answers table</span>
            </div>
            <div class="col-lg-6 pb-3 text-right justify-content-end">
                <a href="/dashboard/discussions/answers/create" class="btn btn-sm bg-violet text-uppercase text-white robot-font">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table mt-4 table-striped table-hover" id="table">
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
                        <a :href="'/dashboard/discussions/answers/'+answer.id+'/edit'" class="btn btn-sm btn-outline-success text-uppercase robot-font">
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

        <div class="row justify-content-end p-3" id="discussions-answers-pagination">
            <pagination :data="this.answers" @pagination-change-page="this.getAnswers"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                answers: {}
            }
        },
        created() {
            this.getAnswers();
        },
        methods: {
            getAnswers(page = 1) {
                this.$http.get('/dashboard/discussions/json-answers?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.answers = data;
                    })
            },
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },
            trimStr(str) {
                let trimed = str.slice(0, 30);
                return trimed += '...'
            }
        }
    }
</script>