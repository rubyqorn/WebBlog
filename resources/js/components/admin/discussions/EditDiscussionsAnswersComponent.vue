<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="edit-discussions-answers">
        <form action="/dashboard/discussions/answers/edit" method="post">
            <input name="_token" type="hidden" :value="csrf">

            <div class="form-group">
                <label for="answer" class="control-label text-muted robot-font text-uppercase">
                    <small>Answer</small>
                </label>

                <ckeditor tag-name="textarea" v-model="answer"></ckeditor>
            </div>
            <div class="form-group">
                <label for="author" class="control-label text-muted robot-font text-uppercase">
                    <small>Author</small>
                </label>

                <input name="author" type="text" class="form-control" v-model="author" readonly>
            </div>
            <div class="form-group border-bottom">
                <label for="discussion" class="control-label text-muted robot-font text-uppercase">
                    <small>Discussion</small>
                </label>

                <div class="col-lg-12 shadow bg-white p-4 mt-3 mb-2 text-center">
                    <a :href="'/discussions/'+this.discussionId" class="robot-font text-muted">
                        {{ this.discussion }}
                    </a>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editAnswer" class="btn btn-sm btn-dark robot-font text-uppercase mt-2 mr-3">
                    <small>Edit</small>
                </button>
            </div>
        </form>

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf'
        ],

        data: function() {
            return {
                answer: null,
                author: null,
                discussion: null,
                discussionId: null,
                message: null,
                currentAnswer: [],
                response: {}
            }
        },

        mounted() {
            this.getCurrentAnswer();
        },

        methods: {
            getCurrentAnswer() {
                let id = window.location.href.split('/')['6'];

                axios.get('/dashboard/discussions/answers/'+id+'/single-json-answer').then(response => {
                    this.currentAnswer = response.data;

                    this.answer = this.currentAnswer['0'].answer;
                    this.author = this.currentAnswer['0'].user.email;
                    this.discussion = this.currentAnswer['0'].discussion.title;
                    this.discussionId = this.currentAnswer['0'].discussion.id; 
                });
            },

            getFormData() {
                let form = new FormData();

                form.append('id', window.location.href.split('/')['6']);
                form.append('answer', this.answer);
                form.append('_token', document.querySelector(
                    '#dashboard #edit-discussions-answers input[name="_token"]'
                ).value);

                return form;
            },

            sendRequest(url, data, header) {
                axios.post(url, data, header).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                });
            },

            editAnswer() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['6'];

                this.sendRequest('/dashboard/discussions/answers/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-discussions-answers input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>