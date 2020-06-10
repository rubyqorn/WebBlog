<template>
    <div class="col-lg-12 rounded shadow bg-white mt-4 mb-4 p-4" id="edit-articles-categories">
        <form action="/dashboard/articles/categories/edit" method="post">
            <input name="_token" type="hidden" :value="csrf">
            
            <div class="form-group">
                <label for="name" class="control-label robot-font text-muted text-uppercase">
                    <small>Name</small>
                </label>

                <input v-model="name" type="text" name="name" class="form-control text-muted robot-font" placeholder="Name of category" required>
            </div>
            <div class="form-group border-bottom pb-2">
                <label for="color" class="robot-font text-muted font-weight-bold control-label text-uppercase">
                    <small>Color</small>
                </label>

                <div class="col-lg-12 row">
                    <div class="form-check mr-2" v-for="color in this.colors">
                        <input type="checkbox" name="color" class="form-check-input" v-on:change="handleCategory" :value="color.value">
                        <label for="color" class="form-check-label text-muted robot-font font-weight-bold">
                            <small>{{ color.name }}</small>
                        </label>
                    </div>

                    <div class="col-lg-12 p-0 m-0">
                        <p class="text-muted robot-font">
                            <small>
                                Color of selected category 
                                <span>{{ color }}</span>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editCategory" class="robot-font btn btn-sm btn-sm btn-dark text-uppercase mr-3 mt-3">
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
                colors: [
                    {'name': 'green', 'value': 'light-green-color'},
                    {'name': 'blue', 'value': 'blue-color'},
                    {'name': 'orange', 'value': 'orange-color'},
                    {'name': 'yellow', 'value': 'yellow-color'},
                    {'name': 'violet', 'value': 'darkslateblue-color'},
                    {'name': 'dark', 'value': 'dark-color'},
                    {'name': 'grey', 'value': 'grey-color'}
                ],

                color: null, 
                name: null,
                currentCategory: [],
                response: {},
                message: null
            }
        },

        mounted() {
            this.getCurrentCategory();
        },

        methods: {
            handleCategory() {
                this.color = document.querySelector(
                    '#dashboard #edit-articles-categories input[name="color"]:checked'
                ).value;
            },

            getCurrentCategory() {
                let id = window.location.href.split('/')['6'];

                axios.get('/dashboard/articles/categories/'+id+'/single-json-category').then(data => {
                    this.currentCategory = data.data;

                    this.name = this.currentCategory['0'].name;
                    this.color = this.currentCategory['0'].color;
                })
            },

            getFormData() {
                let formData = new FormData();

                formData.append('_token', document.querySelector(
                    '#dashboard #edit-articles-categories input[name="_token"]'
                ).value);
                formData.append('id', window.location.href.split('/')['6']);
                formData.append('name', this.name);
                formData.append('color', this.color);

                return formData;
            },

            sendRequest(url, data, header) {
                axios.post(url, data, header).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            editCategory() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['6']; 

                this.sendRequest('/dashboard/articles/categories/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-articles-categories input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>