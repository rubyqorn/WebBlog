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
                    <option selected v-for="discussion in discussions">{{ discussion.id }}</option>
                </select>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf', 'discussions'
        ],

        data: function() {
            return {
                answer: '',
                message: ''
            }
        }
    }
</script>