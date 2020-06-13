<template>
    <div class="container mt-4" id="all-articles">
        <div class="row" >

            <div class="col-lg-5 h-100 mr-1 ml-1 mt-3 mb-4 border rounded shadow" v-for="article in articles.data">
                <a :href="'/article/' + article.id" class="article-img">
                    <img class="w-100 shadow rounded m-1" :src="'/storage/'+ article.image"
                        @mouseover="hover($event)"
                        @mouseout="unHover()"
                    >
                </a>
                <p class="text-muted robot-font">
                    <small>{{ dateFormating(article.created_at) }}</small>
                </p>
                <div class="text-center mb-2">
                    <a v-html="article.title" :href="'/article/' + article.id" class="text-dark robot-font">
                        {{ article.title }}
                    </a>
                </div>

                <div class="col-lg-12 d-flex p-2 mt-2">
                    <div class="col-lg-9">
                        <p class="robot-font" :class="article.category.color">
                            <small>
                                # <span class="font-weight-bold">{{ article.category.name }}</span>
                            </small>
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <p class="robot-font text-right text-muted">
                            <small>
                                <i class="far fa-comment"></i>
                                <span>{{ article.comments_count }}</span>
                            </small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <pagination :data="this.articles" @pagination-change-page="getArticles"></pagination>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                articles: {}
            }
        },
        mounted() {
            this.getArticles();
        },
        methods: {
            hover(event) {
                let targetItem = event.target;

                if (event.type == 'mouseover') {
                    return targetItem.classList.add('activeImage');
                }
            },

            unHover() {
                let articles = document.querySelectorAll('#articles img.w-100');

                for(let i = 0; i < articles.length; i++) {
                    articles[i].classList.remove('activeImage');
                }
            },

            getArticles(page = 1) {

                this.$http.get('json-articles?page=' + page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.articles = data;
                    });
            },

            dateFormating(date) {
                let format = require('dateformat');

                return format(date, 'dd mmm');
            }
        }
    }
</script>