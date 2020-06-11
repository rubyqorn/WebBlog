<template>
    <div class="col-lg-12 shadow bg-white rounded mt-4 mb-4 p-4" id="edit-discussions">
        <form action="/dashboard/discussions/edit" method="post" enctype="multipart/form-data">
            <input name="_token" type="hidden" :value="csrf">

            <div class="form-group">
                <label for="title" class="control-label text-muted text-uppercase robot-font">
                    <small>Title</small>
                </label>

                <ckeditor tag-name="textarea" id="title" v-model="title"></ckeditor>
            </div>
            <div class="form-group">
                <label for="title" class="control-label text-muted text-uppercase robot-font">
                    <small>Description</small>
                </label>
                
                <ckeditor tag-name="textarea" id="description" v-model="description"></ckeditor>
            </div>
            <div class="form-group">
                <label for="answers" class="robot-font text-muted text-uppercase control-label">
                    <small>Counted answers</small>
                </label>

                <input id="answers" type="text" class="form-control robot-font" v-model="answers" readonly>
            </div>
            <div class="form-group">
                <label for="answers" class="robot-font text-muted text-uppercase control-label">
                    <small>Author</small>
                </label>

                <input id="author" type="text" class="form-control robot-font" v-model="author" readonly>
            </div>
            <div class="form-group">
                <label for="category" class="control-label robot-font text-muted text-uppercase">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font text-muted" id="category" v-model="category">
                    <option :name="category.category_id" v-for="category in this.categories">{{ category.name }}</option>
                </select>

                <div class="col-lg-12 p-0 m-0">
                    <p class="text-muted robot-font">
                        <small>
                            Name of selected category 
                            <span class="font-weight-bold">{{ this.category }}</span>
                        </small>
                    </p>
                </div>
            </div>
            <div class="custom-file">
                <label for="image" class="custom-file-label">
                    <small class="robot-font text-muted">
                        <i class="fa fa-camera"></i>
                        <span>Select photo</span>
                    </small>
                </label>

                <input type="file" name="file" ref="file" class="custom-file-input" v-on:change="changeFile">
                
                <div class="col-lg-12 p-0 m-0">
                    <p class="text-muted robot-font">
                        <small>
                            Name of uploaded photo 
                            <span class="font-weight-bold">
                                {{ this.file instanceof Object ? this.file.name : this.file }}
                            </span>
                        </small>
                    </p>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editDiscussion" class="btn btn-sm btn-dark robot-font text-uppercase mt-3 mr-3">
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
            'csrf', 'categories'
        ],

        data: function() {
            return {
                title: null,
                description: null,
                category: null,
                file: null,
                answers: null,
                author: null,
                message: null,
                currentDiscussion: []
            }
        },

        mounted() {
            this.getCurrentDiscussion();
            console.log();
        },

        methods: {
            changeFile() {
                this.file = this.$refs.file.files['0'];
                this.image = this.file.name;
            },

            getCurrentDiscussion() {
                let id = window.location.href.split('/')['5'];

                axios.get('/dashboard/discussions/'+id+'/single-json-discussion').then(response => {
                    this.currentDiscussion = response.data;

                    this.title = this.currentDiscussion['0'].title;
                    this.description = this.currentDiscussion['0'].description;
                    this.category = this.currentDiscussion['0'].category.name;
                    this.file = this.currentDiscussion['0'].image;
                    this.answers = this.currentDiscussion['0'].answers_count;
                    this.author = this.currentDiscussion['0'].authors.email;
                });
            },

            getFormData(url, data, headers) {
                let form = new FormData();

                form.append('id', window.location.href.split('/')['5']);
                form.append('_token', document.querySelector(
                    '#dashboard #edit-discussions input[name="_token"]'
                ).value);
                form.append('category', $('#dashboard #edit-discussions #category :selected')
                    .attr('name')
                );
                form.append('title', this.title);
                form.append('description', this.description);
                form.append('image', this.file);

                return form;
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;
                    
                    if(this.response.status == '200') {
                        this.message = this.response.message;
                    }
                    
                });
            },

            editDiscussion() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['5'];

                this.sendRequest('/dashboard/discussions/'+id+'/edit', data, {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-discussions input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>