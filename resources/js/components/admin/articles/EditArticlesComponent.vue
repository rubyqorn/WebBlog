<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 shadow rounded bg-white" id="edit-articles">
        <form action="/dashboard/articles/edit" method="post">
            <input type="hidden" name="_token" :value="csrf">

            <div class="form-group">
                <label for="title" class="control-label text-muted robot-font text-uppercase">
                    <small>Title</small>
                </label>

                <ckeditor tab-name="textarea" v-model="title"></ckeditor>
            </div>

            <div class="form-group">
                <label for="description" class="control-label text-muted robot-font text-uppercase">
                    <small>Description</small>
                </label>

                <ckeditor tab-name="textarea" v-model="description"></ckeditor>
            </div>

            <div class="form-group">
                <label for="category" class="robot-font text-muted control-label text-uppercase">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font text-muted" id="category" v-on:change="handleCategory">
                    <option :name="category.category_id" selected v-for="category in categories">{{ category.name }}</option>
                </select>

                <p class="text-muted robot-font" id="category-name">
                    <small>
                        ID of previous selected category
                        <span>{{ this.category }}</span> 
                    </small>
                </p>
            </div>

            <div class="form-group row justify-content-end">
                <button @click.prevent="editArticle" class="btn btn-sm btn-dark text-uppercase robot-font mt-3 mr-3">
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
            'csrf', 'categories'
        ],

        data: function() {
            return {
                title: null,
                description: null,
                category: null,
                message: null,
                currentArticle: [],
                response: {},
            }
        },

        mounted() {
            this.getCurrentArticle();
        },

        methods: {
            handleCategory() {
                this.category = $('#dashboard #edit-articles #category :selected')
                    .attr('name');
            },

            getCurrentArticle() {
                let id = window.location.href.split('/')['5']
                
                axios.get('/dashboard/news/'+ id +'/single-json-articles').then(response => {
                    this.currentArticle = response.data;
                    this.category = this.currentArticle['0'].category_id;
                    this.title = this.currentArticle['0'].title;
                    this.description = this.currentArticle['0'].description;
                });
            },

            getFormData() {
                let form = new FormData();

                form.append('_token', document.querySelector(
                    '#dashboard #edit-articles input[name="_token"]'
                ).value);
                form.append('id', window.location.href.split('/')['5']);
                form.append('title', this.title);
                form.append('description', this.description);
                form.append('category', this.category);

                return form;
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            editArticle() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['5'];

                this.sendRequest('/dashboard/articles/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-articles input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>