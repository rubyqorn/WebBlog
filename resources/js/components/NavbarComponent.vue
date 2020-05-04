<template>
    
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="collapse navbar-collapse  justify-content-center" id="navbar-content">
            <ul class="navbar-nav mr-4">
                <li class="nav-item d-flex ml-2" v-for="link in links">
                    <i class="fa fa-home text-muted mt-3" :class="link.icon"></i>
                    <a :href="`${link.link}`" class="nav-link robot-font mt-1">
                        {{ link.name }}
                    </a>                    
                </li>
            </ul>
        </div>
    </nav>
    
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
                {link: "/articles", name: "Статьи", icon: "fa-file"},
                {link: "/discussions", name: "Дискуссии", icon: "fa-comments"}
            ]}
        }
    }
</script>