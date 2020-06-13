<template>
    <div class="col-lg-9 mb-4 mt-2">        
        <div class="col-lg-12 border rounded p-4 mt-3" v-for="discussion in discussions">
            <div class="d-flex">
                <img :src="'/storage/'+ discussion.authors.image" class="avatar">
                <p v-html="discussion.authors.name" class="robot-font text-dark ml-2">
                    <small>{{ discussion.authors.name }}</small>
                </p>
                <p class="text-muted robot-font ml-4">
                    <small>
                        создано в категории
                        <span class="text-info"># {{ discussion.category.name }}</span>
                        <span>{{ dateFormation(discussion.created_at) }}</span>
                    </small>
                </p>
            </div>

            <div class="col-lg-12 mt-4 p-3 rounded border">
                <a v-html="discussion.title" :href="'/discussion/'+ discussion.id" class="text-muted robot-font">
                    {{ discussion.title }}
                </a>
            </div>

            <div class="row mt-3">
                <div class="col-lg-9">
                    <p class="text-muted robot-font">
                        <small>
                            Количество ответов
                            <span class="text-info">{{ discussion.answers_count }}</span>
                        </small>
                    </p>
                </div>
                <div class="col-lg-3 text-right">
                    <a :href="'/discussion/' + discussion.id" class="btn btn-dark btn-sm robot-font">
                        Ответить
                    </a>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'discussions'
        ],
        methods: {
            dateFormation(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    }
</script>