<template>  
    <div class="col-lg-12 rounded shadow bg-white mt-4 p-4 mb-4" id="edit-news-categories">
        <form action="/dashboard/news/categories/edit" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="name" class="robot-font font-weight-bold text-muted control-label text-uppercase">
                    <small>Name</small>
                </label>

                <input name="name" type="text" class="form-control robot-font text-muted p-3" v-model="name">
            </div>
            <div class="form-group border-bottom pb-2">
                <label for="color" class="robot-font text-muted font-weight-bold control-label text-uppercase">
                    <small>Color</small>
                </label>

                <div class="col-lg-12 row">
                    <div class="form-check mr-2" v-for="color in this.colors">
                        <input v-on:change="handleColorName" type="checkbox" name="color" class="form-check-input" :value="color.value">
                        <label for="color" class="form-check-label text-muted robot-font font-weight-bold">
                            <small>{{ color.name }}</small>
                        </label>
                    </div>
                    <div class="col-lg-12 p-0 m-0">
                        <span class="text-muted robot-font" id="category-name">
                            <small>
                                Previous color name:
                                <span>{{ this.color }}</span>
                            </small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editCategory" type="submit" class="mr-2 btn btn-dark btn-sm text-uppercase robot-font">
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
            'csrf'
        ],

        data: function() {
            return {
                colors: [
                    {'name': 'green', 'value': 'light-green-color'},
                    {'name': 'blue', 'value': 'blue-color'},
                    {'name': 'orange', 'value': 'orange-color'},
                    {'name': 'yellow', 'value': 'yellow-color'},
                    {'name': 'violet', 'value': 'darkslateblue-color'},
                    {'name': 'dark', 'value': 'dark-color'},
                    {'name': 'grey', 'value': 'grey-color'}
                ],

                message: null,
                response: {},
                currentCategory: [],
                color: null,
                name: null
            }
        },

        mounted() {
            this.getCurrentCategoryData();
        },

        methods: {
            getCurrentCategoryData() {
                let id = window.location.href.split('/')['6'];
                
                axios.get('/dashboard/news/categories/'+ id +'/single-json-category').then(response => {
                    this.currentCategory = response.data;

                    this.color = this.currentCategory['0'].color;
                    this.name = this.currentCategory['0'].name;
                });
            },

            handleColorName() {
                this.color = document.querySelector(
                    '#dashboard #edit-news-categories input[name="color"]:checked'
                ).value;
            },

            getFormData() {
                let form = new FormData();

                form.append('_token', document.querySelector(
                    '#dashboard #edit-news-categories input[name="_token"]'
                ).value);
                form.append('category_id', window.location.href.split('/')['6']);
                form.append('name', this.name);
                form.append('color', this.color);

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

            editCategory() {
                let data = this.getFormData();
                let id = this.currentCategory['0'].category_id;

                this.sendRequest('/dashboard/news/categories/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-news-categories input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>