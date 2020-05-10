<template>
    <div class="container mt-4" id="single-news-item">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                <div class="col-lg-12">
                    <h2 class="robot-cond-font">
                        {{ news.title }}
                    </h2>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="row">
                        <div class="col-lg-7">
                            <p class="text-muted robot-cond-font">
                                <small>
                                    Новость была опубликована {{ dateFormating(news.created_at) }}
                                </small>
                            </p>
                        </div>
                        <div class="d-flex col-lg-5 justify-content-end">
                            <a :href="link.url" class="ml-1 text-muted text-right" v-for="link in links">
                                <i class="fab" :class="link.name"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <img :src="'/'+ news.image" class="w-100 rounded">
                    <h5 class="robot-cond-font text-muted text-center mt-2 font-weight-bold">
                        <small>{{ news.title }}</small>
                    </h5>
                </div>

                <div class="col-lg-12 mt-4" id="content">
                    <p class="robot-cond-font">
                        {{ news.description }}
                    </p>
                </div>

            </div>

            <div class="col-lg-8" id="comments">

                <div class="col-lg-12 mt-4">
                    <h5 class="text-muted robot-font">
                        Комментарии:
                    </h5>
                    <hr>
                </div>

                <div class="col-lg-12 border rounded p-3 mt-4" v-for="comment in comments">
                    <div class="d-flex">
                        <img :src="'/assets/img/'+ comment.user.image" class="avatar h-100">
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

            <div class="col-lg-8 mt-4">
                <form action="/" method="post" class="mt-4">
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="custom-file">
                        <label for="image" class="custom-file-label">
                            <small>
                                <i class="fa fa-camera text-muted"></i>
                                <span class="robot-font text-muted">Выбрать фото</span>
                            </small>
                        </label>
                        <input type="file" class="custom-file-input" name="file">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-dark robot-font btn-sm">
                            Отправить
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'news', 'comments'
        ],
        data: function() {
            return {
                links: [
                    {name: 'fa-github', url: 'https://github.com/rubyqorn'},
                    {name: 'fa-vk', url: 'https://vk.com/rubyqorn'}
                ]
            }
        },
        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    }
</script>