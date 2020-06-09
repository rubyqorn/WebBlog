<template>
    <div class="col-lg-12 p-4 mt-4 mb-4 rounded shadow bg-white" id="create-discussions">
        <form action="/dashboard/discussions/create" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            
            <div class="form-group">
                <label for="title" class="control robot-font text-muted text-uppercase">
                    <small>Title</small>
                </label>

                <ckeditor id="title" v-model="title">
                    <textarea name="title" class="form-control robot-font text-muted" required></textarea>
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="description" class="control-label robot-font text-muted text-uppercase">
                    <small>Description</small>
                </label>

                <ckeditor id="description" v-model="description">
                    <textarea name="description" class="form-control robot-font text-muted" required></textarea>
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="category" class="robot-font control-label text-uppercase text-muted">
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

                <input type="file" ref="file" class="custom-file-input" id="file" v-on:change="selectFile">
            </div>
            
            <div class="form-group row justify-content-end">
                <button @click.prevent="createDiscussions" class="btn btn-sm btn-dark text-uppercase robot-font mt-3 mr-3">
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
                message: '',
                data: {}
            }
        },

        methods: {
            selectFile() {
                this.file = this.$refs.file.files['0'];
            },

            getFormData() {
                let form = new FormData();

                form.append('_token', document.querySelector(
                    '#dashboard #create-discussions input[name="_token"]'
                ).value);
                form.append('category', document.querySelector(
                    '#dashboard #create-discussions #category'
                ).value);
                form.append('title', this.title);
                form.append('description', this.description);
                form.append('file', this.file);

                return form;
            },

            clearForm() {
                this.title = '';
                this.description = '';
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(response => {
                    this.data = response.data;

                    if (this.data.status_code == '200') {
                        this.message = this.data.message;
                        
                        this.clearForm();
                    }
                });
            },

            createDiscussions() {
                let data = this.getFormData();
                this.sendRequest('/dashboard/discussions/create', data, {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #create-discussions input[name="_token"]'
                    ).value
                });

                $('#toast-container #toast').toast('show')
            }
        }
    }
</script>