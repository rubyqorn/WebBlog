<template>
    <div class="col-lg-12 p-0 m-0" id="new-news-comments" v-if="comments">
        <div class="col-lg-12 border rounded p-3 mt-4" v-for="comment in comments">
            <div class="d-flex">
                <img :src="'/storage/'+ comment.user.image" class="avatar h-100">
                <p class="text-dark robot-font ml-2">
                    <small>{{ comment.user.name }}</small>
                </p>

                <p class="text-muted robot-font ml-4">
                    <small>
                        оставлен
                        {{ dateFormating(comment.created_at) }}
                    </small>
                </p>
            </div>
            <div class="col-lg-12 mt-4">
                <p class="text-dark robot-cond-font">
                    {{ comment.comment }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'comments'
        ],

        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    }
</script>