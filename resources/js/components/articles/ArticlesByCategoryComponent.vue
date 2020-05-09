<template>
    <div class="container-fluid" id="articles-by-category">
        <div class="row justify-content-center">

            <div class="col-lg-8 mt-4 p-4 rounded border shadow bg-white" id="last-article-from-category">
                <div class="row">

                    <div class="col-lg-7">
                        <a :href="'/article/' + lastArticle.id">
                            <img :src="'/' + this.lastArticle.image" class="preview-img rounded shadow w-100">
                        </a>
                    </div>

                    <div class="col-lg-5 mt-4 p-3">
                        <a :href="'/article/' + lastArticle.id" class="h6 mb-3 robot-font text-dark">
                            # {{ lastArticle.title }}
                        </a>
                        <p class="text-muted robot-font p-2">
                            <small>{{ this.stringTriming(lastArticle.description) }}</small>
                        </p>
                        <div class="row">
                            <div class="d-flex pl-4">
                                <img :src="'/assets/img/' + lastArticle.author.image" class="avatar">
                                <p class="robot-font text-dark ml-3">
                                    <small>{{ lastArticle.author.name }}</small>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="container mt-4 mb-4">
                <div class="row justify-content-center">
                    
                    <div class="col-lg-5 ml-2 rounded border p-3 shadow bg-white" v-for="article in articles">
                        <a :href="'/article/' + article.id" class="mt-4">
                            <img :src="'/' + article.image" class="preview-img rounded shadow w-100">
                        </a>
                        <div class="mt-4">
                            <a :href="'/article/' + article.id" class="mt-4 robot-font text-dark text-center">
                                # {{ article.title }}
                            </a>
                            <div class="row">
                                <div class="d-flex mt-2 ml-4">
                                    <p class="text-muted robot-font">
                                        <small>
                                            <i class="far fa-comment"></i>
                                            {{ article.comments_count }}
                                        </small>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end mt-2 h-100">
                                    <p class="robot-font mr-2">
                                        <small>{{ article.author.name }}</small>
                                    </p>
                                    <img :src="'/assets/img/' + article.author.image" class="avatar">
                                </div>
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
            'articles'
        ],
        data: function() {
            return {
                lastArticle: this.articles.shift()
            }
        },
        methods: {
            stringTriming(str) {
                let trimed = str.slice(0, 200);
                return trimed += '...';
            }
        }
    }
</script>