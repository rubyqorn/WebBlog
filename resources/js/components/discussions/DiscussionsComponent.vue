<template>
    <div class="col-lg-7">
        <div class="col-lg-12 mt-4 fade show bg-success alert alert-dismissible" v-if="status">
            <button class="close text-white font-weight-bold robot-font" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <strong class="text-white robot-font">{{ status }}</strong>
        </div>

        <div class="col-lg-12 mt-4 fade show alert-dismissible alert bg-danger" v-if="errors">
            <button class="close text-white robot-font font-weight-bold" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <strong class="text-white" v-for="error in errors">{{ error }}</strong>
        </div>

        <div class="col-lg-12 h-100">
            <div class="col-lg-12 border rounded p-3 mt-4" v-for="discussion in discussions.data">
                <div class="d-flex">
                    <img :src="'assets/img/' + discussion.authors.image" class="avatar">
                    <p class="robot-font ml-2">
                        <small>{{ discussion.authors.name }}</small>
                    </p>
                    <p class="text-muted ml-4 robot-font">
                        <small>
                            создано в категории 
                            <span class="text-info"># {{ discussion.category.name }}</span>
                            {{ dateFormating(discussion.created_at) }}
                        </small>
                    </p>
                </div>

                <div class="col-lg-12 mt-4 border rounded p-3">
                    <a :href="'/discussion/'+ discussion.id" class="text-muted robot-font">
                        {{ discussion.title }}
                    </a>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-9 justify-content-start">
                        <p class="text-muted robot-font">
                            <small>
                                Количество ответов
                                <span class="text-info border-bottom">
                                    {{ discussion.answers_count }}
                                </span>
                            </small>
                        </p>
                    </div>
                    <div class="col-lg-3 text-right justify-content-end">
                        <a :href="'/discussion/' + discussion.id" class="btn btn-dark btn-sm robot-font">
                            Ответить
                        </a>
                    </div>
                </div>
            </div>

        <div class="col-lg-12 mt-4">
            <pagination :data="discussions" @pagination-change-page="getDiscussions"></pagination>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'status', 'errors'
        ],
        data: function() {
            return {
                discussions: {}
            }
        },
        mounted() {
            this.getDiscussions();
        },
        methods: {
            getDiscussions(page = 1) {

                this.$http.get('/json-discussions?page=' + page)
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        this.discussions = data
                    });
            },

            dateFormating(date) {
                let format = require('dateformat');

                return format(date, 'dd mmm');
            }
        }
    }
</script>