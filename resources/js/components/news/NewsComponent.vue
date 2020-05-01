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
                    <small>{{ news.created_at }}</small>
                </p>
                <div class="text-center mb-2">
                    <a :href="`${ '/news/' + news.id }`" class="text-dark robot-font">
                        {{ news.title }}
                    </a>
                </div>
            </div>

        </div>
    </div>
 
                 
                
</template>

<script>
    export default {
        data: function() {
            return {
                activeImage: false,
                news: []
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

            getNews(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                axios.get('/json-news?page=' + page).then(response => {
                    this.news = response.data;
                });
            }
        }
    }
</script>