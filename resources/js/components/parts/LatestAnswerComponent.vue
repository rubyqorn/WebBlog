<template>
    <div class="col-lg-12 p-0 m-0" id="new-news-comments" v-if="answers">
        <div class="col-lg-12 border p-3 mt-4" v-for="answer in answers">
            <div class="d-flex">
                <img :src="'/assets/img/'+ answer.user.image" class="avatar h-100">
                <p class="text-dark robot-font ml-2">
                    <small>{{ answer.user.name }}</small>
                </p>

                <p class="text-muted robot-font ml-4">
                    <small>
                        оставлен
                        {{ dateFormating(answer.created_at) }}
                    </small>
                </p>
            </div>
            <div class="col-lg-12 mt-4">
                <p class="text-dark robot-cond-font">
                    {{ answer.answer }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'answers'
        ],

        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    }
</script>