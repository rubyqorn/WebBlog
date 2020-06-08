<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="edit-news-item">
        <form action="/dashboard/news/edit" method="post" v-for="item in this.news">
            <input name="_token" type="hidden" :value="csrf">

            <div class="form-group">
                <label for="title" class="control-label text-muted robot-font text-uppercase font-weight-bold">
                    <small>Title</small>
                </label>
                
                <ckeditor tag-name="textarea" v-model="title" id="title"></ckeditor>    
            </div>

            <div class="form-group">
                <label for="description" class="control-label text-muted robot-font text-uppercase font-weight-bold">
                    <small>Description</small>
                </label>

                <ckeditor id="description" tag-name="textarea" v-model="description"></ckeditor>
            </div>

            <div class="form-group mt-3">
                <label for="category" class="control-label robot-font text-muted text-uppercase font-weight-bold">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font" name="category" id="category" v-on:change="handleCategory">
                    <option class="robot-font" :name="category.category_id" v-for="category in categories">
                        {{ category.name }}
                    </option>
                </select>

                <p class="text-muted robot-font" id="category-name">
                    <small>
                        ID of selected category is
                        <span>{{ item.category_id }}</span>    
                    </small>
                </p>
            </div>

            <div class="form-group p-4 row justify-content-end">
                <button @click.prevent="editNews" class="btn btn-sm btn-dark text-uppercase robot-font">
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

        data() {
            return {
                news: [],
                response: {},
                title: null,
                description: null,
                category: null,
                message: null
            }
        },

        mounted() {
            this.getSelectedPost();
        },

        methods: {
            handleCategory() {
                return this.category = $('#dashboard #edit-news-item #category :selected').attr('name');
            },

            getDefaultCategory() {
                return $('#dashboard #edit-news-item #category-name small span').text();
            },

            getSelectedPost() {
                let id = window.location.href.split('/')['5'];
                
                axios.get('/dashboard/news/'+id+'/single-json-news').then(response => {
                    this.news = response.data;
                    this.title = this.news['0'].title;
                    this.description = this.news['0'].description;
                });
            },

            getFormData() {
                let form = new FormData();

                form.append('_token', document.querySelector(
                    '#dashboard #edit-news-item input[name="_token"]'
                ).value);
                form.append(
                    'category', this.category !== null ? this.category : this.getDefaultCategory()
                );
                form.append('title', this.title);
                form.append('description', this.description);
                form.append('id', this.news['0'].id);

                return form;
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                });
            },

            editNews() {
                let data = this.getFormData();

                this.sendRequest('/dashboard/news/'+this.news['0'].id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-news-item input[name="_token"]'
                    ).value
                });           

                $('#toast').toast('show');
            }
        }
    }
</script>