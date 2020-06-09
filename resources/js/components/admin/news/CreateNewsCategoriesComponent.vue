<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="create-news-categories">
        <form action="/dashboard/news/categories/create" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="name" class="robot-font font-weight-bold text-muted control-label text-uppercase">
                    <small>Name</small>
                </label>

                <input name="name" type="text" class="form-control robot-font text-muted p-3">
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
                <button @click.prevent="createCategory" type="submit" class="mr-2 btn btn-dark btn-sm text-uppercase robot-font">
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
                response: {},
                message: ''
            }
        },

        methods: {
            pushRequest(url, data) {
                axios.post(url, data).then(response => {
                    this.response = response;

                    if (this.response.data.status == '200') {
                        this.message = this.response.data.message;
                    }
                })
            },

            getFormData() {
                return {
                    _token: document.querySelector(
                        '#dashboard #create-news-categories input[name="_token"]'
                    ).value,
                    name: document.querySelector(
                        '#dashboard #create-news-categories input[name="name"]'
                    ).value,
                    color: document.querySelector(
                        '#dashboard #create-news-categories input[name="color"]:checked'
                    ).value
                };
            },

            createCategory() {
                let data = this.getFormData();

                this.pushRequest('/dashboard/news/categories/create', data);
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>