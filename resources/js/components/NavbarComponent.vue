<template>
    
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="collapse navbar-collapse  justify-content-center" id="navbar-content">
            <ul class="navbar-nav mr-4">
                <li class="nav-item d-flex ml-2">
                    <i class="fa fa-home text-muted mt-3"></i>
                    <a :href="this.mainpage" class="nav-link robot-font mt-1">Главная</a>                    
                </li>
                <li class="nav-item d-flex ml-2">
                    <i class="fas fa-newspaper text-muted mt-3"></i>
                    <a :href="this.newspage" class="nav-link robot-font mt-1">Новости</a>                    
                </li>
                <li class="nav-item d-flex ml-2">
                    <i class="fa fa-list-alt text-muted mt-3"></i>
                    <a :href="this.articlespage" class="nav-link robot-font mt-1">Статьи</a>                    
                </li>
                <li class="nav-item d-flex ml-2">
                    <i class="far fa-comments text-muted mt-3"></i>
                    <a :href="this.discussionspage" class="nav-link robot-font mt-1">Дискуссии</a>                    
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
        ]
    }
</script>