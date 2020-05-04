<template>
    <div class="container mt-4">
        <div class="row" >

            <div class="col-lg-5 h-100 mr-1 ml-1 mt-3 mb-4 border rounded shadow" v-for="news in news.data">
                <a :href="`${'/news/' + news.id}`" class="article-img">
                    <img class="w-100 shadow rounded m-1" :src="`${ news.image }`"
                        @mouseover="hover($event)"
                        @mouseout="unHover()"
                    >
                </a>
                <p class="text-muted robot-font">
                    <small>{{ dateFormating(news.created_at) }}</small>
                </p>
                <div class="text-center mb-2">
                    <a :href="`${ '/news/' + news.id }`" class="text-dark robot-font">
                        {{ news.title }}
                    </a>
                </div>

                <div class="col-lg-12 d-flex p-2 mt-2">
                    <div class="col-lg-9">
                        <p class="robot-font" :class="news.category.color">
                            <small>
                                # <span class="font-weight-bold">{{ news.category.name }}</span>
                            </small>
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <p class="robot-font text-right text-muted">
                            <small>
                                <i class="far fa-comment"></i>
                                <span>{{ news.comments_count }}</span>
                            </small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <pagination :data="news" @pagination-change-page="getNews"></pagination>
            </div>

        </div>
    </div>
          
</template>

<script>
    export default {
        data: function() {
            return {
                activeImage: false,
                news: {}
            }
        },
        mounted() {
            this.getNews();
        },
        methods: {
            hover(event) {
                let target = event.target;

                if(event.type == 'mouseover') {
                    return target.classList.add('activeImage');
                } 
            },

            unHover() {
                let images = document.querySelectorAll('#news img.w-100');

                for(let i = 0; i < images.length; i++) {
                    images[i].classList.remove('activeImage')
                }
            },

            getNews(page = 1) {

                this.$http.get('/json-news?page=' + page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.news = data;
                    });
            },

            dateFormating(date) {
                let format = require('dateformat');

                return format(date, 'dd mmm');
            }
        }
    }
</script>