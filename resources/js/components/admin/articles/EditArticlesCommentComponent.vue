<template>
    <div class="col-lg-12 shadow bg-white mt-4 mb-4 p-4 rounded" id="edit-articles-comment">
        <form action="/dashboard/articles/comments/edit" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="comment" class="control-label text-muted robot-font text-uppercase">
                    <small>Comment</small>
                </label>
                <ckeditor tag-name="textarea" id="comment" v-model="comment"></ckeditor>
            </div>
            <div class="form-group">
                <label for="comment" class="control-label text-muted robot-font text-uppercase">
                    <small>Author</small>
                </label>
                <input type="text" class="form-control" v-model="author" readonly>
            </div>
            <div class="form-group">
                <label for="post" class="control-label text-muted robot-font text-uppercase">
                    <small>Post name</small>
                </label>
                <div class="text-center p-4 shadow bg-white rounded">
                    
                    <a :href="'/articles/'+postId" class="robot-font text-muted">
                        {{ this.post }}
                    </a>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editComment" class="mr-3 mt-3 btn btn-dark btn-sm text-uppercase robot-font">
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
                comment: null,
                author: null,
                post: null,
                postId: null,
                message: null,
                currentComment: [],
                response: {}
            }
        },

        mounted() {
            this.getCurrentComment();
        },

        methods: {
            getCurrentComment() {
                let id = window.location.href.split('/')['6'];

                axios.get('/dashboard/articles/comment/'+id+'/single-json-comment').then(response => {
                    this.currentComment = response.data;

                    this.comment = this.currentComment['0'].comment;
                    this.author = this.currentComment['0'].user.name;
                    this.post = this.currentComment['0'].article.title;
                    this.postId = this.currentComment['0'].article.id;
                });
            },

            getFormData() {
                let form = new FormData();

                form.append('id', window.location.href.split('/')['6']);
                form.append('comment', this.comment);
                form.append('_token', document.querySelector(
                    '#dashboard #edit-articles-comment input[name="_token"]'
                ).value);
        
                return form;
            },

            sendRequest(url, data, header) {
                axios.post(url, data, header).then(data => {
                    this.response = data.data;

                    if(this.response.status_code == '200') {
                        this.message = this.response.message
                    }
                });
            },

            editComment() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['6'];

                this.sendRequest('/dashboard/articles/comments/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-articles-comment input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        },
    }
</script>