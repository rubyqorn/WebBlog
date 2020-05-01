<template>

    <div class="col-lg-5 h-100 mr-1 ml-1 mt-3 mb-4 border rounded shadow">
        <a :href="`${route}`" class="article-img">
            <img class="w-100 shadow rounded m-1" :src="`${ img }`"
                @mouseover="hover($event)"
                @mouseout="unHover()"
            >
        </a>
        <p class="text-muted robot-font">
            <small>{{ date }}</small>
        </p>
        <div class="text-center mb-2">
            <a :href="`${ route }`" class="text-dark robot-font">
                {{ title }}
            </a>
        </div>
    </div>

 
                 
                
</template>

<script>
    export default {
        props: [
            'title', 'date', 'img',
            'author', 'comments',
            'route'
        ],
        data: function() {
            return {
                activeImage: false,
            }
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
            }
        }
    }
</script>