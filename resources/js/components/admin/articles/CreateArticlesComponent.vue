<template>
    <div class="col-lg-12 p-4 mt-4 mb-4 rounded bg-white shadow" id="create-articles">
        <form action="/dashboard/articles/create" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">

            <div class="form-group">
                <label for="title" class="control-label text-muted robot-font text-uppercase">
                    <small>Title</small>
                </label>

                <ckeditor id="title" v-model="title">
                    <textarea name="title" class="form-control" required></textarea>
                </ckeditor>
            </div>

            <div class="form-group">
                <label for="description" class="control-label text-muted robot-font text-uppercase">
                    <small>Description</small>
                </label>

                <ckeditor id="description" v-model="description">
                    <textarea name="description" class="form-cotnrol" required></textarea>
                </ckeditor>
            </div>

            <div class="form-group">
                <label for="category" class="robot-font text-muted control-label text-uppercase">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font text-muted" id="category">
                    <option selected v-for="category in categories">{{ category.name }}</option>
                </select>
            </div>

            <div class="custom-file">
                <label for="file" class="custom-file-label robot-font text-muted">
                    <small>
                        <i class="fa fa-camera"></i>
                        <span class="ml-2">Select photo</span>
                    </small>
                </label>

                <input type="file" name="file" ref="file" class="custom-file-input" id="file" v-on:change="handleImageSelecting" required>
            </div>

            <div class="form-group row justify-content-end">
                <button @click.prevent="createArticles" class="btn btn-sm btn-dark text-uppercase robot-font mt-3 mr-3">
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
                title: '',
                description: '',
                file: '',
                responseData: {},
                message: ''
            }
        },

        methods: {
            sendRequest(url, data, headers){

                axios.post(url, data, headers).then(response => {
                    this.responseData = response.data;

                    if(this.responseData.status == '200') {
                        this.message = this.responseData.message;
                        let toast = document.querySelector(
                            '#dashboard #toast'
                        )
                        
                        this.showToast(toast);
                        this.clearForm();

                        this.hideToast();
                    }
                });

            },

            handleImageSelecting() {
                this.file = this.$refs.file.files['0'];
            },

            getFormData() {
                let formData = new FormData();

                console.log(this.file);

                formData.append('title', this.title);
                formData.append('description', this.description);
                formData.append('image', this.file);
                formData.append('_token', document.querySelector(
                    '#dashboard #create-articles input[name="_token"]'
                ).value);
                formData.append('category', document.querySelector(
                    '#dashboard #create-articles #category'
                ).value);

                return formData;
            },

            clearForm() {
                this.title = '';
                this.description = '';
            },

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

            createArticles() {
                let data = this.getFormData();

                this.sendRequest('/dashboard/articles/create', data, {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #create-articles input[name="_token"]'
                    ).value
                });
            }
        }
    }
</script>