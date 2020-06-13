<template>
    <div class="container mt-4" id="single-news-item">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                <div class="col-lg-12">
                    <h2 v-html="news.title" class="robot-cond-font">
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
                    <img :src="'/storage/'+ news.image" class="w-100 rounded">
                    <h5 v-html="'<small>'+ news.title +'</small>'" class="robot-cond-font text-muted text-center mt-2 font-weight-bold">
                        <small>{{ news.title }}</small>
                    </h5>
                </div>

                <div v-html="news.description" class="col-lg-12 mt-4 robot-cond-font" id="content">
                    {{ news.description }}
                </div>

            </div>

            <div class="col-lg-8" id="comments">

                <div class="col-lg-12 mt-4">
                    <h5 class="text-muted robot-font">
                        Комментарии:
                    </h5>
                    <hr>
                </div>

                <latest-comments
                    :comments="this.createdComment"
                ></latest-comments>

                <div class="col-lg-12 border rounded p-3 mt-4" v-for="comment in this.comments">
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

            <div class="col-lg-8 mt-4">
                <p class="text-muted robot-font border-bottom">
                    <small> 
                        Вы не сможете оставить комментарий, 
                        если вы не <a class="text-primary" href="/register">
                            зарегистрировались
                        </a> 
                        или не <a class="text-primary" href="/login">вошли</a>
                        в свой аккаунт
                    </small>
                </p>
                <form :action="'/news/'+ news.id +'/comments'" method="post" class="mt-4" id="comment-form">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group">
                        <textarea name="comment" class="form-control" id="comment" rows="5"></textarea>
                    </div>
                    <div class="form-group mt-4">
                        <button @click.prevent="leaveComment" class="btn btn-dark robot-font btn-sm">
                            Отправить
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <toast-component
            :message="this.message"
        ></toast-component>

    </div>
</template>

<script>
    export default {
        props: [
            'news', 'csrf'
        ],
        data: function() {
            return {
                comments: {},
                links: [
                    {name: 'fa-github', url: 'https://github.com/rubyqorn'},
                    {name: 'fa-vk', url: 'https://vk.com/rubyqorn'}
                ],
                response: {},
                createdComment: [],
                message: '',
            }
        },
        created() {
            this.getComments();
        },
        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            },

            getComments() {
                this.$http.get('/news/' + this.news.id + '/comments')
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        this.comments = data;
                    })

            },

            getCreatedComment() {
                axios.get('/last-comments/news').then(response => {
                    this.createdComment.push(response.data);
                })
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            getCommentsData() {
                let form = new FormData();

                form.append('comment', document.querySelector(
                    '#news #single-news-item #comment-form #comment'
                ).value);
                form.append('id', window.location.href.split('/')['4']);
                form.append('_token', document.querySelector(
                    '#news #single-news-item #comment-form input[name="_token"]'
                ).value);

                return form;
            },

            clearCommentField() {
                return document.querySelector(
                    '#news #single-news-item #comment'
                ).value = '';
            },
 
            leaveComment() {
                let formData = this.getCommentsData();

                this.sendRequest('/news/'+news.id+'/comments', formData, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#news #single-news-item #comment-form input[name="_token"]'
                    ).value
                });

                this.getCreatedComment();
                this.clearCommentField();
                $('#toast-container #toast').toast('show');
            }
        }
    }
</script>