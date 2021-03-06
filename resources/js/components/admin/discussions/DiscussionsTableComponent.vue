<template>
    <div class="col-lg-12 mt-4 mb-4 p-4 rounded shadow bg-white" id="discussions-table">
        <div class="col-lg-12 row border-bottom">
            <div class="col-lg-6 robot-font text-info">
                <span class="h6"># Discussions table</span>
            </div>
            <div class="col-lg-6 justify-content-end text-right">
                <a href="/dashboard/discussions/create" class="mb-3 btn btn-sm btn-info text-white text-uppercase robot-font">
                    <small>Create</small>
                </a>
            </div>
        </div>

        <slot></slot>

        <table class="table table-striped table-hover mt-4 mb-4" id="table">
            <thead class="bg-primary">
                <tr class="robot-font text-white font-weight-bold">
                    <td>#</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Answers</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </thead>
            <tbody>
                <tr class="robot-font" v-for="discussion in this.discussions.data">
                    <td class="font-weight-bold">{{ discussion.id }}</td>
                    <td class="text-muted">{{ trimString(discussion.title) }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.authors.name }}</td>
                    <td class="text-muted font-weight-bold">{{ discussion.answers_count }}</td>
                    <td class="text-muted">{{ dateFormating(discussion.created_at) }}</td>
                    <td>
                        <a href="#" data-toggle="modal" :data-target="'#delete-'+discussion.id" class="btn btn-sm btn-outline-info robot-font text-uppercase">
                            <small>Delete</small>
                        </a> 
                    </td>
                    <td>
                       <a :href="'/dashboard/discussions/'+discussion.id+'/edit'" class="btn btn-sm btn-outline-primary robot-font text-uppercase">
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
                    <td>Answers</td>
                    <td>Created</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
            </tfoot>
        </table>

        <admin-toast-component
            :message="this.message"
        ></admin-toast-component>

        <div class="modal fade show" :id="'delete-'+discussion.id" v-for="discussion in this.discussions.data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-muted robot-font">
                            Delete record with {{ discussion.id }} id
                        </span>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger font-weight-bold robot-font">
                            Are you sure you want delete record with {{ discussion.id }} id ???
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form :action="'/dashboard/discussions/'+discussion.id+'/delete'" method="post" id="delete-discussions">
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-sm btn-dark text-uppercase robot-font">
                                    <small>No</small>
                                </button>

                                <button @click.prevent="deleteDiscussion" class="btn btn-sm btn-danger text-uppercase robot-font text-uppercase">
                                    <small>Yes</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 p-3 row justify-content-end" id="discussions-pagination">
            <pagination :data="this.discussions" @pagination-change-page="this.getDiscussions"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                discussions: {},
                response: {},
                message: null
            }
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
            },

            trimString(str) {
                let trimed = str.slice(0,30);
                return trimed += '...';
            },

            sendRequest(uri) {
                axios.post(uri).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            deleteDiscussion() {
                let uri = document.querySelector(
                    '#dashboard #discussions-table #delete-discussions'
                ).getAttribute('action');

                this.sendRequest(uri);

                $('#dashboard #discussions-table .modal').modal('hide');
                $('#toast-container #toast').toast('show');
            }   
        }
    }
</script>