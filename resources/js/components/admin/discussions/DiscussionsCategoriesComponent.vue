<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded bg-white shadow" id="discussions-categories-table">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span># Discussions categories table</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/dashboard/discussions/categories/create" class="btn btn-sm bg-raspberry mb-3 text-uppercase text-white font-weight-bold">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table table-striped table-hover table-border mt-4" id="table">
            <thead class="text-white bg-raspberry font-weight-bold robot-font">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
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
                        <a href="/" class="btn btn-outline-secondary btn-sm text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a :href="'/dashboard/discussions/categories/'+category.category_id+'/edit'" class="btn btn-outline-dark btn-sm text-uppercase robot-font">
                            <small>Update</small>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot class="text-white bg-raspberry font-weight-bold robot-font">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Created</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </tfoot>
        </table>
        <div class="row justify-content-end p-3" id="discussions-categories-pagination">
            <pagination :data="this.categories" @pagination-change-page="this.getCategories"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                categories: {}
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            getCategories(page = 1) {
                this.$http.get('/dashboard/discussions/json-categories?page='+ page)
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
            }
        }
    }
</script>