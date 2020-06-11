<template>
    <div class="col-lg-12 shadow bg-white rounded mt-4 mb-4 p-4" id="edit-discussions-category">
        <form action="/dashboard/discussions/categories/edit">
            <input name="_token" type="hidden" :value="csrf">

            <div class="form-group">
                <label for="name" class="control-label text-muted robot-font text-uppercase">
                    <small>Name</small>
                </label>

                <input name="name" type="text" class="form-control" v-model="name">
            </div>
            <div class="form-group border-bottom pb-2">
                <label for="color" class="robot-font text-muted font-weight-bold control-label text-uppercase">
                    <small>Color</small>
                </label>

                <div class="col-lg-12 row">
                    <div class="form-check mr-2" v-for="color in this.colors" id="color">
                        <input type="checkbox" name="color" class="form-check-input" v-on:change="changeColor" :value="color.value">
                        <label for="color" class="form-check-label text-muted robot-font font-weight-bold">
                            <small>{{ color.name }}</small>
                        </label>
                    </div>
                </div>

                <div class="col-lg-12 p-0 m-0">
                    <p class="text-muted robot-font">
                        <small>
                            Selected color name: 
                            <span class="font-weight-bold">
                                {{ this.color }}
                            </span>
                        </small>
                    </p>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="editCategory" class="mt-2 mr-3 btn btn-sm btn-dark text-uppercase robot-font">
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

        mounted() {
            this.getCurrentCategory();
        },

        data: function() {
            return {
                name: null,
                color: null,
                message: null,
                response: {},
                currentCategory: [],

                colors: [
                    {'name': 'green', 'value': 'light-green-color'},
                    {'name': 'blue', 'value': 'blue-color'},
                    {'name': 'orange', 'value': 'orange-color'},
                    {'name': 'yellow', 'value': 'yellow-color'},
                    {'name': 'violet', 'value': 'darkslateblue-color'},
                    {'name': 'dark', 'value': 'dark-color'},
                    {'name': 'grey', 'value': 'grey-color'}
                ]
            }
        },

        methods: {
            getCurrentCategory() {
                let id = window.location.href.split('/')['6'];

                axios.get('/dashboard/discussions/categories/'+id+'/single-json-category').then(response => {
                    this.currentCategory = response.data;

                    this.name = this.currentCategory['0'].name;
                    this.color = this.currentCategory['0'].color;
                });
            },

            changeColor() {
                this.color = document.querySelector(
                    '#dashboard #edit-discussions-category #color :checked'
                ).value;
            },

            getFormData() {
                let form = new FormData();

                form.append('id', window.location.href.split('/')['6']);
                form.append('_token', document.querySelector(
                    '#dashboard #edit-discussions-category input[name="_token"]'
                ).value);
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
                })
            },

            editCategory() {
                let data = this.getFormData();
                let id = window.location.href.split('/')['6'];

                this.sendRequest('/dashboard/discussions/categories/'+id+'/edit', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #edit-discussions-category input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>