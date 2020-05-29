<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="discussions-table">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># Discussions table</span>
            </div>
            <div class="col-lg-6 justify-content-end text-right">
                <a href="/" class="mb-3 btn btn-sm btn-info text-white text-uppercase robot-font">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <table class="table table-striped table-hover mt-4 mb-4">
            <thead class="bg-primary">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="discussion in this.discussions.data">
                    <td class="font-weight-bold">{{ discussion.id }}</td>
                    <td class="text-muted">{{ trimString(discussion.title) }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.author.name }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.comments_count }}</td>
                    <td class="text-muted">{{ dateFormating(discussion.created_at) }}</td>
                    <td>
                        <a href="/" class="btn btn-sm btn-outline-info robot-font text-uppercase">
                            <small>Delete</small>
                        </a> 
                    </td>
                    <td>
                       <a href="/" class="btn btn-sm btn-outline-primary robot-font text-uppercase">
                            <small>Edit</small>
                        </a> 
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-primary">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Comments</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <div class="col-lg-12 p-3 row justify-content-end">
            <pagination :data="this.discussions" @pagination-change-page="this.getDiscussions"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                discussions: {}
            }
        },
        mounted() {
            console.log('Mounted');
        },
        created() {
            this.getDiscussions();
        },
        methods: {
            getDiscussions(page = 1) {
                this.$http.get('/json-discussions?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.discussions = data;
                    });
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            }   
        }
    }
</script>