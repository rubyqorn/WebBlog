<template>
    <div class="col-lg-12 rounded bg-white shadow mt-4 mb-4 p-4" id="create-discussions-categories">
        <form action="/dashboard/discussions/categories/create" method="post">
            <input type="hidden" name="_token" :value="csrf">

            <div class="form-group">
                <label for="name" class="control-label text-muted text-uppercase robot-font">
                    <small>Name</small>
                </label>

                <input type="text" class="robot-font text-muted form-control" name="name" placeholder="Category name" required>
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
                <button @click.prevent="createCategory" class="btn btn-sm btn-dark text-uppercase robot-font mt-3 mr-3">
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
                message: '',
            }
        },

        methods: {
            showToast(toast) {
                toast.classList.remove('hide');
                toast.classList.add('show');
            },

            hideToast() {
                let hideToastBtn = document.querySelector(
                    '#dashboard #toast #hide-toast'
                );

                hideToastBtn.addEventListener('click', function() {
                    let toast = document.querySelector(
                        '#dashboard #toast'
                    );

                    toast.classList.add('hide');
                    toast.classList.remove('show');
                });
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                        let toast = document.querySelector(
                            '#dashboard #toast'
                        );

                        this.showToast(toast);
                        this.hideToast();
                    }
                })
            },

            getFormData() {
                let form = new FormData();

                form.append('name', document.querySelector(
                    '#dashboard #create-discussions-categories input[name="name"]'
                ).value);
                form.append('color', document.querySelector(
                    '#dashboard #create-discussions-categories input[name="color"]:checked'
                ).value);
                form.append('_token', document.querySelector(
                    '#dashboard #create-discussions-categories input[name="_token"]'
                ).value);

                return form;
            },

            createCategory() {
                let data = this.getFormData();

                this.sendRequest('/dashboard/discussions/categories/create', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #create-discussions-categories input[name="_token"]'
                    ).value
                });
            }
        }
    }
</script>