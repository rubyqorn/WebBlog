<template>
    <div class="container mt-4" id="single-article-item">
        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="col-lg-12">
                    <h2 v-html="article.title" class="robot-cond-font">
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

                <div class="col-lg-12 mt-4 row justify-content-center">
                    <img :src="'/storage/'+ article.image" class="w-100 rounded">
                    <p v-html="article.title" class="robot-cond-font mt-2 text-muted text-center">
                        {{ article.title }}
                    </p>
                </div>

                <div class="robot-cond-font mt-4" id="content">
                    <p v-html="article.description" class="robot-cond-font">
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

                <latest-comments
                    :comments="this.lastComments"
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

                <div class="col-lg-12 mt-4">
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
                    <form :action="'/article/'+ article.id + '/comments'" method="post" class="mt-4" id="comment-form">
                        <input type="hidden" name="_token" :value="csrf">

                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <button @click.prevent="leaveComment" class="btn btn-dark btn-sm robot-font">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
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
            'article', 'csrf'
        ],
        data: function() {
            return {
                links: [
                    {icon: 'fa-github', url: 'https://github.com/rubyqorn'},
                    {icon: 'fa-vk', url: 'https://vk.com/rubyqorn'}
                ],
                comments: {},
                lastComments: [],
                response: {},
                message: ''
            }
        },
        mounted() {
            this.getComments();   
        },
        methods: {
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            },

            getComments() {
                this.$http.get('/article/'+ this.article.id + '/comments')
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        this.comments = data;
                    });
            },

            getLastCreatedComment(url) {
                axios.get(url).then(data => {
                    this.lastComments.push(data.data);
                });
            },

            sendRequest(url, data, headers) {
                axios.post(url, data, headers).then(data => {
                    this.response = data.data;

                    if (this.response.status_code == '200') {
                        this.message = this.response.message;
                    }
                })
            },

            getFormData() {
                let form = new FormData();

                form.append('comment', document.querySelector(
                    '#articles #single-article-item #comment-form #comment'
                ).value);
                form.append('id', window.location.href.split('/')['4']);
                form.append('_token', document.querySelector(
                    '#articles #single-article-item #comment-form input[name="_token"]'
                ).value);

                return form;
            },

            clearForm() {
                document.querySelector(
                    '#articles #single-article-item #comment-form #comment'
                ).value = '';
            },

            leaveComment() {
                let data = this.getFormData();

                this.sendRequest('/article/'+this.article.id+'/comments', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#articles #single-article-item #comment-form input[name="_token"]'
                    ).value
                });

                this.getLastCreatedComment('/last-comments/article');
                this.clearForm();
                $('#toast-container #toast').toast('show');
            }   
        }
    }
</script>