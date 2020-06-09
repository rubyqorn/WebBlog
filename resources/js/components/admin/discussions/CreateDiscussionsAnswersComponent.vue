<template>
    <div class="col-lg-12 rounded shadow bg-white mt-4 mb-4 p-4" id="create-answers">
        <form action="/dashboard/discussions/answers/create" method="post">
            <input type="hidden" name="_token" :value="csrf">

            <div class="form-group">
                <label for="answer" class="control-label text-muted robot-font text-uppercase">
                    <small>Answer</small>
                </label>

                <ckeditor id="answer" v-model="answer">
                    <textarea name="answer" class="form-control robot-font text-muted"></textarea>
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="category" class="robot-font control-label text-uppercase text-muted">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font text-muted" id="discussion">
                    <option v-for="discussion in discussions">{{ discussion.id }}</option>
                </select>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="createAnswer" class="btn btn-sm btn-dark robot-font text-uppercase mt-3 mr-3">
                    <small>Create</small>
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
            'csrf', 'discussions'
        ],

        data: function() {
            return {
                response: {},
                answer: '',
                message: ''
            }
        },

        methods: {
            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;
                    let toast = document.querySelector(
                        '#dashboard #toast'
                    );

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }

                });
            },

            getFormData() {
                let form = new FormData();

                form.append('answer', this.answer);
                form.append('discussion', document.querySelector(
                    '#dashboard #create-answers #discussion'
                ).value);
                form.append('_token', document.querySelector(
                    '#dashboard #create-answers input[name="_token"]'
                ).value);

                return form;
            },

            createAnswer() {
                let data = this.getFormData();

                this.sendRequest('/dashboard/discussions/answers/create', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #create-answers input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>