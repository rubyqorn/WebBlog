<template>
    <div class="container-fluid" id="news-by-category">
        <div class="row justify-content-center">

            <div class="col-lg-8 shadow bg-white rouded border p-4 mt-4" id="last-news-by-category" v-if="lastNews">
                <div class="row">
                
                    <div class="col-lg-7">
                        <a :href="'/news/'+ lastNews.id">
                            <img :src="'/'+ lastNews.image" class="w-100 rounded shadow preview-img">
                        </a>
                    </div>

                    <div class="col-lg-5 mt-4">
                        <a :href="'/news/'+ lastNews.id" class="h6 mb-4 robot-font text-dark">
                            # {{ lastNews.title }}
                        </a>
                        <p class="text-muted robot-font">
                            <small>{{ this.stringTriming(lastNews.description) }}</small>
                        </p>
                        <div class="col-lg-12">
                            <p class="text-muted robot-font">
                                <small>{{ this.dateFormating(lastNews.created_at) }}</small>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container mt-4 mb-4">
                <div class="row justify-content-center">

                    <div class="col-lg-5 rounded shadow bg-white border ml-2 p-3" v-for="item in news">
                        <a :href="'/news/'+ item.id">
                            <img :src="'/' + item.image" class="w-100 shadow rounded preview-img">
                        </a>
                        <div class="mt-4">
                            <p class="text-dark robot-font">
                                # {{ item.title }}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <p class="text-muted robot-font">
                                    <small>
                                        <i class="far fa-comment"></i>
                                        <span class="ml-1">{{ item.comments_count }}</span>
                                    </small>
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <p class="text-muted robot-font text-right">
                                    <small>
                                        {{ dateFormating(item.created_at) }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'news'
        ],
        data: function() {
            return {
                lastNews: this.news.shift()
            }
        },
        methods: {
            stringTriming(str) {
                let trimed = str.slice(0, 200);
                return trimed += '...';
            },
            
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    }
</script>