<template>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="navbar">
        <div class="d-flex">
            <a href="/" class="navbar-brand">
                <i class="fa fa-bolt text-warning"></i>
            </a>
            <a href="/" class="navbar-brand text-dark robot-font">
                WebBlog
            </a>
        </div>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-content">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="ml-auto navbar-nav" id="navbar-content">
            <li class="nav-item dropdown">
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
    </nav>

</template>

<script>
    export default {
        props: [
            'csrf', 'user'
        ],
        methods: {
            logout() {
                return document.getElementById('logout-form').submit();
            }
        }
    }

</script>