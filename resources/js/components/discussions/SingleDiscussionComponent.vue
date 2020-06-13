<template>
    <div class="container mt-4" id="single-discussion-item">
        <div class="row">
            
            <div class="col-lg-8 mt-4" v-for="item in discussion">
                <div class="row">
                    <div class="col-lg-7 d-flex h-100">
                        <img :src="'/storage/'+ item.authors.image" class="avatar h-100">
                        <p class="text-dark robot-font ml-2">
                            <small>
                                {{ item.authors.name }}
                            </small>
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <p class="text-right text-muted robot-font">
                            <small>
                                опубликовано {{ dateFormating(item.created_at) }}
                            </small>
                        </p>
                    </div>
                </div>

                <div class="col-lg-12 bg-white shadow p-4 rouded">
                    <h3 v-html="item.title" class="text-dark robot-font font-weight-bold">
                        {{ item.title }}
                    </h3>
                    <p class="badge badge-pill badge-dark robot-font">
                        <small>
                            # {{ item.category.name }}
                        </small>
                    </p>

                    <div class="col-lg-12" v-if="item.image">
                        <a role="button" class="border-bottom mt-4" data-toggle="modal" data-target="#image">
                            <img :src="'/storage/'+ item.image" class="w-100 rounded">
                        </a>

                        <p v-html="item.description" class="text-dark robot-cond-font mt-4">
                            {{ item.description }}
                        </p>

                        <div class="modal fade" id="image">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img :src="'/storage/'+ item.image" class="w-100 rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-top mt-4" v-else>
                        <p v-html="item.description" class="text-dark robot-font mt-2">
                            {{ item.description }}
                        </p>
                    </div>

                    <div class="col-lg-12 mt-4" id="comments">
                        <div class="col-lg-12 border-bottom">
                            <h5 class="robot-font text-muted">
                                Ответы
                            </h5>
                        </div>

                        <latest-answers
                            :answers="lastCreatedAnswer"
                        ></latest-answers>

                        <div class="col-lg-12 rounded mt-3" v-for="answer in answers">
                            <div class="row">

                                <div class="col-lg-9 d-flex h-100">
                                    <img :src="'/storage/'+ answer.user.image" class="avatar h-100">
                                    <p class="text-dark robot-font ml-2">
                                        <small>{{ answer.user.name }}</small>
                                    </p>
                                </div>

                                <div class="col-lg-3">
                                    <p class="text-muted robot-font text-right">
                                        <small>{{ dateFormating(answer.created_at) }}</small>
                                    </p>
                                </div>
                            </div>

                            <div class="col-lg-12 p-2">
                                <p v-html="answer.answer" class="text-dark robot-cond-font">
                                    {{ answer.answer }}
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

                            <form :action="'/discussion/'+ item.id + '/answers'" method="post" id="create-answer">
                                <input type="hidden" name="_token" :value="csrf">

                                <div class="form-group">
                                    <textarea id="answer" name="answer" class="form-control" rows="5"></textarea>
                                </div>

                                <div class="form-group mt-4">
                                    <button @click.prevent="leaveAnswer" class="btn btn-dark robot-font btn-sm">
                                        Ответить
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>

            <div class="col-lg-4" id="last-five-discussions">
                <div class="card">
                    <div class="card-header robot-font">
                        Новые обсуждения
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="discussion in this.lastDiscussions">
                                <a v-html="discussion.title" :href="'/discussion/'+ discussion.id" class="robot-font text-dark">
                                    {{ stringTriming(discussion.title) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <toast-component
                    :message="message"
                ></toast-component>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'discussion', 'csrf'
        ],
        data: function() {
            return {
                answers: {},
                lastDiscussions: {},
                response: {},
                message: '',
                lastCreatedAnswer: []
            }
        },
        created() {
            this.getAnswers();
            this.getLastDiscussions();
        },
        methods: {
            stringTriming(str) {
                let trimedStr = str.slice(0, 30);
                return trimedStr += '...';
            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            },

            getAnswers() {
                this.$http.get('/discussion/'+ this.discussion['0'].id + '/answers')
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.answers = data;
                    });
            },

            getLastDiscussions() {
                this.$http.get('/discussions/last-discussions')
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        this.lastDiscussions = data;
                    })
            },

            getLastCreatedAnswer(url) {
                axios.get(url).then(data => {
                    this.lastCreatedAnswer.push(data.data);
                });
            },

            getFormData() {
                let form = new FormData();

                form.append('answer', document.querySelector(
                    '#discussions #single-discussion-item #comments #create-answer #answer'
                ).value);
                form.append('_token', document.querySelector(
                    '#discussions #single-discussion-item #comments #create-answer input[name="_token"]'
                ).value);
                form.append('id', this.discussion['0'].id);

                return form;
            },

            sendRequest(url, data, header) {
                axios.post(url, data, header).then(data => {
                    this.response = data.data;

                    if (this.response.status == '200') {
                        this.message = this.response.message;
                    }
                 })
            },

            clearForm() {
                document.querySelector(
                    '#discussions #single-discussion-item #comments #create-answer #answer'
                ).value = '';
            },

            leaveAnswer() {
                let data = this.getFormData();

                this.sendRequest('/discussion/'+ this.discussion['0'].id + '/answers', data, {
                    'X-CSRF-TOKEN': document.querySelector(
                        '#discussions #single-discussion-item #comments #create-answer input[name="_token"]'
                    ).value
                });

                this.getLastCreatedAnswer('/last-answers/discussions')
                $('#toast-container #toast').toast('show');
                this.clearForm();
            }
        }
    } 
</script>