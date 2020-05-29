<template>
    <div class="col-lg-12 rounded shadow bg-white mt-4 mb-4 p-4" id="articles-categories">
        <div class="col-lg-12 border-bottom row">
            <div class="col-lg-6">
                <span class="robot-font text-info h6"># Articles categories table</span>
            </div>
            <div class="col-lg-6 text-right justify-content-end">
                <a href="/" class="mb-3 btn btn-sm btn-dark robot-font text-uppercase">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <table class="table table-hover table-striped mt-4">
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
                        <a href="/" class="btn btn-outline-secondary btn-sm text-uppercase robot-font">
                            <small>Delete</small>
                        </a>
                    </td>
                    <td>
                        <a href="/" class="btn btn-outline-dark btn-sm text-uppercase robot-font">
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
            }
        }
    }
</script>