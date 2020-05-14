<template>
    <div class="container mt-4" id="single-discussion-item">
        <div class="row">
            
            <div class="col-lg-8 mt-4" v-for="item in discussion">
                <div class="row">
                    <div class="col-lg-7 d-flex h-100">
                        <img :src="'/assets/img/'+ item.authors.image" class="avatar h-100">
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
                    <h3 class="text-dark robot-font font-weight-bold">
                        {{ item.title }}
                    </h3>
                    <p class="badge badge-pill badge-dark robot-font">
                        <small>
                            # {{ item.category.name }}
                        </small>
                    </p>

                    <div class="col-lg-12" v-if="item.image">
                        <a role="button" class="border-bottom mt-4" data-toggle="modal" data-target="#image">
                            <img :src="'/'+ item.image" class="w-100 rounded">
                        </a>

                        <p class="text-dark robot-cond-font mt-4">
                            {{ item.description }}
                        </p>

                        <div class="modal fade" id="image">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img :src="'/'+ item.image" class="w-100 rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 border-top mt-4" v-else>
                        <p class="text-dark robot-font mt-2">
                            {{ item.description }}
                        </p>
                    </div>

                    <div class="col-lg-12 mt-4" id="comments">
                        <div class="col-lg-12 border-bottom">
                            <h5 class="robot-font text-muted">
                                Ответы
                            </h5>
                        </div>

                        <div class="col-lg-12 rounded mt-3" v-for="answer in answers">
                            <div class="row">

                                <div class="col-lg-9 d-flex h-100">
                                    <img :src="'/assets/img/'+ answer.user.image" class="avatar h-100">
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
                                <p class="text-dark robot-cond-font">
                                    {{ answer.answer }}
                                </p>
                            </div>
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
                            <li class="list-group-item" v-for="discussion in lastdiscussions">
                                <a :href="'/discussion/'+ discussion.id" class="robot-font text-dark">
                                    {{ stringTriming(discussion.title) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'discussion', 'lastdiscussions', 'answers'
        ],
        methods: {
            stringTriming(str) {
                let trimedStr = str.slice(0, 20);
                return trimedStr += '...';
            },
            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            }
        }
    } 
</script>