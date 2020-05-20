<template>
    <nav class="navbar navbar-light bg-light sticky-top navbar-expand-lg" id="navbar">
        <a href="/" class="navbar-brand text-warning">
            <i class="fa fa-bolt"></i>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-content">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link robot-font">Главная</a>
                </li>
                <li class="nav-item">
                    <a href="/news" class="nav-link robot-font">Новости</a>
                </li>
                <li class="nav-item">
                    <a href="/articles" class="nav-link robot-font">Статьи</a>
                </li>
                <li class="nav-item">
                    <a href="/discussions" class="nav-link robot-font">Дискуссии</a>
                </li>
            </ul>

            
            <ul class="navbar-nav ml-auto">
                <div class="d-flex" v-if="typeof(this.user) == 'undefined'">
                    <li class="nav-item mr-1">
                        <a href="/login" class="robot-font nav-link">
                            Войти
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="robot-font nav-link">
                            Регистрация
                        </a>    
                    </li>
                </div>

                <li class="nav-item dropdown" v-else>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{this.user}} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/logout" @click.prevent="logout">
                            Выйти
                        </a>

                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf">
                        </form>
                    </div>
                </li>

            </ul>
            
        </div>

    </nav>
</template>

<script>
    export default {
        props: [   
            'user', 'csrf'
        ],
        data: function() {
            return {
                authUser: null
            }
        },
        methods: {
            logout() {
                return document.getElementById('logout-form').submit()
            }
        }
    }
</script>