<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="create-news">
        <form action="/dashboard/news/store" method="post" enctype="multipart/form-data">
            <input name="_token" type="hidden" :value="csrf">

            <div class="form-group">
                <label for="title" class="control-label text-muted robot-font text-uppercase font-weight-bold">
                    <small>Title</small>
                </label>
                
                <ckeditor name="title" v-model="title">
                    <textarea name="title" class="form-control" rows="2" required></textarea>
                </ckeditor>    
            </div>

            <div class="form-group">
                <label for="description" class="control-label text-muted robot-font text-uppercase font-weight-bold">
                    <small>Description</small>
                </label>

                <ckeditor name="description" v-model="description">
                    <textarea name="description" class="form-control" rows="5" required></textarea>
                </ckeditor>
            </div>

            <div class="form-group mt-3">
                <label for="category" class="control-label robot-font text-muted text-uppercase font-weight-bold">
                    <small>Category</small>
                </label>

                <select class="custom-select robot-font" name="category" id="category">
                    <option class="robot-font" v-for="category in categories">{{ category.name }}</option>
                </select>
            </div>

            <div class="custom-file">
                <label for="file" class="custom-file-label text-muted robot-font">
                    <small>
                        <i class="fa fa-camera"></i>
                        <span>Select a photo</span>
                    </small>
                </label>

                <input ref="file" type="file" id="file" name="file" class="custom-file-input" v-on:change="handleFileUpload" required>
            </div>

            <div class="form-group p-4 row justify-content-end">
                <button @click.prevent="createNews" class="btn btn-sm btn-dark text-uppercase robot-font">
                    <small>Create</small>
                </button>
            </div>
        </form>
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
                response: {}
            }
        },

        methods: {
            handleFileUpload() {
                this.file = this.$refs.file.files['0'];
            },

            getFormData() {
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('description', this.description);
                formData.append('file', this.file);
                formData.append('category', document.querySelector(
                    '#dashboard #create-news #category'
                ).value);

                return formData;
            },

            pushRequest(url, data, headers) {

                axios.post(url, data, headers).then(data => {
                    this.response = data.data;
                }).catch(error => console.log(error));
            },

            createNews() {
                let data = this.getFormData()                

                const headers = {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector(
                        '#dashboard #create-news input[name="_token"]'
                    ).value
                };

                this.pushRequest('/dashboard/news/store', data, headers);
            }
        }
    }
</script>