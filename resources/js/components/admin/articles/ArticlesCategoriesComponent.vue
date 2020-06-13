<template>
    <div class="col-lg-12 rounded shadow bg-white mt-4 mb-4 p-4" id="articles-categories">
        <div class="col-lg-12 border-bottom row">
            <div class="col-lg-6">
                <span class="robot-font text-info h6"># Articles categories table</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/dashboard/articles/categories/create" class="mb-3 btn btn-sm btn-dark robot-font text-uppercase">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table table-hover table-striped mt-4" id="table">
            <thead class="bg-peach rounded">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Name</td>
                    <td>Color</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in this.categories.data">
                    <td class="font-weight-bold">{{ category.category_id }}</td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ category.name }}
                    </td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ category.color }}
                    </td>
                    <td class="text-muted font-weight-bold robot-font">
                        {{ dateFormating(category.created_at) }}
                    </td>
                    <td>
                        <a href="#" role="button" data-toggle="modal" :data-target="'#delete-'+category.category_id" class="btn btn-outline-secondary btn-sm text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/articles/categories/'+category.category_id+'/edit'" class="btn btn-outline-dark btn-sm text-uppercase robot-font">
                            <small>Update</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-peach rounded">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Name</td>
                    <td>Color</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>

        <div class="modal fade show" :id="'delete-'+category.category_id" v-for="category in this.categories.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ category.category_id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ category.category_id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/articles/categories/'+category.category_id+'/delete'" method="post" id="delete-articles-category">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteCategory" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 p-3 row justify-content-end" id="articles-categories-pagination">
            <pagination :data="this.categories" @pagination-change-page="this.getCategories"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                categories: {},
                message: null,
                response: {}
            }
        },
        created() {
            this.getCategories()
        },
        methods: {
            getCategories(page = 1) {
                this.$http.get('/dashboard/articles/json-categories?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.categories = data;
                    })
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            deleteCategory() {
                let uri = document.querySelector(
                    '#dashboard #articles-categories #delete-articles-category'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #articles-categories .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>