<template>
    <div class="container mt-4" id="single-article-item">
        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="col-lg-12">
                    <h2 class="robot-cond-font">
                        {{ article.title }}
                    </h2>   
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="row">
                        <div class="col-lg-7">
                            <p class="text-muted robot-fond-font">
                                <small>
                                    Статья была опубликована {{ dateFormating(article.created_at) }}
                                </small>
                            </p>
                        </div>
                        <div class="col-lg-5 d-flex justify-content-end">
                            <a :href="link.url" class="text-muted ml-2" v-for="link in links">
                                <i class="fab" :class="link.icon"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <img :src="'/'+ article.image" class="w-100 rounded">
                    <p class="robot-cond-font mt-2 text-muted text-center">
                        {{ article.title }}
                    </p>
                </div>

                <div class="robot-cond-font mt-4" id="content">
                    <p class="robot-cond-font">
                        {{ article.description }}
                    </p>
                </div>

            </div>

            <div class="col-lg-8 mt-4" id="comments">
                <div class="col-lg-12">
                    <h5 class="text-muted robot-font">
                        Комментарии:
                    </h5>
                    <hr>
                </div>

                <div class="col-lg-12 border rounded p-3 mt-4" v-for="comment in comments">
                    <div class="d-flex">
                        <img :src="'/assets/img/'+ comment.users.image" class="avatar h-100">
                        <p class="text-dark robot-font ml-2">
                            <small>{{ comment.users.name }}</small>
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

                <div class="col-lg-12 mt-4">
                    <form action="/" method="post" class="mt-4">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="custom-file">
                            <label for="file" class="custom-file-label text-muted">
                                <small>
                                    <i class="fa fa-camera"></i>
                                    <span>Выбрать фото</span>
                                </small>
                            </label>
                            <input type="file" name="file" class="custom-file-input">
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-dark btn-sm robot-font">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'article', 'comments'
        ],
        data: function() {
            return {
                links: [
                    {icon: 'fa-github', url: 'https://github.com/rubyqorn'},
                    {icon: 'fa-vk', url: 'https://vk.com/rubyqorn'}
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