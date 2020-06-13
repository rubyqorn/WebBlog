<template>
    <div class="col-lg-12 bg-white shadow rounded mt-4 mb-4 p-4" id="users-list">
        <div class="col-lg-12 border-bottom">
            <span class="h6 robot-font text-info font-weight-bold"># List of last users</span>
        </div>
        <table class="mt-4 table table-border table-stripped table-hover">
            <thead class="bg-info text-white">
                <tr class="font-weight-bold robot-font">
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody class="robot-font">
                <tr v-for="user in this.users.data">
                    <td class="font-weight-bold">{{ user.id }}</td>
                    <td><img :src="'/storage/'+ user.image" class="avatar"></td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.roles.name }}</td>
                    <td>{{ dateFormating(user.created_at) }}</td>
                </tr>
            </tbody>
            <tfoot class="bg-info text-white">
                <tr class="font-weight-bold robot-font">
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                </tr>
            </tfoot>
        </table>
        <div class="row justify-content-end p-3">
            <pagination :data="this.users" @pagination-change-page="this.getUsers"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                users: {}
            }
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers(page = 1) {
                this.$http.get('/users?page='+ page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.users = data;
                    })
            },
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm, yy');
            }
        }
    }
</script>