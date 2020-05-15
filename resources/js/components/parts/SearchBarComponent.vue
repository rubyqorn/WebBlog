<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="col-lg-7 ml-4 mt-4" id="search-bar">
                <div class="col-lg-12 ml-4 mt-4">
                    <form :action="route" method="post">
                        <input type="hidden" name="_token" :value="csrftoken">
                        <div class="form-group d-flex border rounded">
                            <select class="custom-select w-25 robot-font" name="category">
                                <option selected></option>
                                <option class="robot-font" v-for="category in categories">{{ category.name }}</option>
                            </select>
                            <input class="form-control robot-font" name="searching" placeholder="| Type your request">
                            <button type="submit" class="search-btn" @click.prevent="search">
                                <i class="fa fa-search text-muted"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5 ml-1 mr-1 mb-4 h-100 border rounded border p-2" v-for="item in items.data">
                <a :href="`${link + item.id}`" class="article-img">
                    <img class="w-100 shadow rounded m-1" :src="'/'+ item.image"
                        @mouseover="hover($event)"
                        @mouseout="unhover()"
                    >
                        
                </a>
                <p class="text-muted robot-font">
                    <small>{{ dateFormating(item.created_at) }}</small>
                </p>
                <div class="text-center mb-2">
                    <a :href="`${ link + item.id }`" class="text-dark robot-font">
                        {{ item.title }}
                    </a>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'categories', 'route', 'csrftoken'
        ],
        data: function() {
            return {
                items: {},
                link: ''
            }
        },
        methods: {
            getItems(resource, data) {
                axios.post(resource, data).then(response => {
                    this.items = response;
                });
            },

            search() {
                let categoryField = document.querySelector('#search-bar form select').value;
                let tokenField = document.querySelector('#search-bar form input[name="_token"]').value;
                let searchingField = document.querySelector('#search-bar form input[name="searching"]').value;
                let resource = document.querySelector('#search-bar form').getAttribute('action');
                let data = {
                    _token: tokenField,
                    category: categoryField,
                    searching: searchingField
                };

                this.getItems(resource, data);

                let parsedResource = this.parseResource(resource);
                this.link = '/'+ parsedResource + '/';

                this.removeAllItemsBlock(parsedResource);
                this.removeSocialLinksSidebar(parsedResource);

            },

            dateFormating(date) {
                let format = require('dateformat');
                return format(date, 'dd mmm');
            },

            parseResource(resource) {
                return resource.split('/')['1'];
            },

            removeAllItemsBlock(blockName) {
                let block = document.querySelector('#all-'+ blockName);

                if(block == null) {
                    return false;
                }

                return block.remove();
            },

            removeSocialLinksSidebar(blockName) {
                let block = document.querySelector('#'+ blockName + ' #social-links-sidebar');

                if(block == null) {
                    return false;
                }

                return block.remove();
            },

            hover(event) {
                let target = event.target;

                if(event.type == 'mouseover') {
                    return target.classList.add('activeImage');
                } 
            },

            unhover() {
                let images = document.querySelectorAll('#news img.w-100');

                for(let i = 0; i < images.length; i++) {
                    images[i].classList.remove('activeImage')
                }
            }

        }
    }
</script>