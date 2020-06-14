<template>
    
    <div class="col-lg-12 border-bottom border-top p-4 mt-4">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-content">
                <span class="navbar-toggler-icon"></span> 
            </button>
            <div class="collapse navbar-collapse  justify-content-center" id="navbar-content">
                <ul class="navbar-nav mr-4">
                    <li class="nav-item d-flex ml-2" v-for="link in links">
                        <i class="fa text-muted mt-3 mr-1" :class="link.icon"></i>
                        <a :href="`${link.link}`" class="nav-link robot-font mt-1">
                            {{ link.name }}
                        </a>                    
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
</template>

<script>
    export default {
        props: [
            'mainpage', 'newspage',
            'articlespage', 'discussionspage' 
        ],
        data: function() {
            return { links: [
                {link: "/", name: "Главная", icon: "fa-home"},
                {link: "/news", name: "Новости", icon: "fa-newspaper"},
                {link: "/articles", name: "Статьи", icon: "fa-book"},
                {link: "/discussions", name: "Дискуссии", icon: "fa-comments"}
            ]}
        }
    }
</script>