<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 shadow bg-white rounded" id="create-articles-categories">
        <form action="/dashboard/articles/categories/create" method="post">
            <input name="_token" type="hidden" :value="csrf">
            <div class="form-group">
                <label for="name" class="control-label robot-font text-muted text-uppercase">
                    <small>Name</small>
                </label>

                <input type="text" name="name" class="form-control text-muted robot-font" placeholder="Name of category" required>
            </div>
            <div class="form-group border-bottom pb-2">
                <label for="color" class="robot-font text-muted font-weight-bold control-label text-uppercase">
                    <small>Color</small>
                </label>

                <div class="col-lg-12 row">
                    <div class="form-check mr-2" v-for="color in this.colors">
                        <input type="checkbox" name="color" class="form-check-input" :value="color.value">
                        <label for="color" class="form-check-label text-muted robot-font font-weight-bold">
                            <small>{{ color.name }}</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <button @click.prevent="createCategory" class="robot-font btn btn-sm btn-sm btn-dark text-uppercase mr-3 mt-3">
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
                name: '',
                color: '',
                responseData: {},
                message: '',
            }
        },

        methods: {
            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(response => {
                    this.responseData = response.data;
                    let toast = document.querySelector(
                        '#dashboard #toast'
                    );

                    if(this.responseData.status_code == '200') {
                        this.message = this.responseData.message;
                    }

                })
            },

            getCategoryData() {
                let form = new FormData();
                this.name = document.querySelector(
                    '#dashboard #create-articles-categories input[name="name"]'
                ).value;
                this.color = document.querySelector(
                    '#dashboard #create-articles-categories input[name="color"]:checked'
                ).value;

                form.append('name', this.name);
                form.append('color', this.color);
                form.append('_token', document.querySelector(
                    '#dashboard #create-articles-categories input[name="_token"]'
                ).value);
                

                return form;
            },

            createCategory() {
                let data = this.getCategoryData();

                this.sendRequest('/dashboard/articles/categories/create', data, {
                    'X-CSRF_TOKEN': document.querySelector(
                        '#dashboard #create-articles-categories input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show');
            }
            
        }
    }
</script>