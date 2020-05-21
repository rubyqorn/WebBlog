<template>
    <div class="container" id="login-form">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow p-0">

                    <div class="card-header">
                        Войти
                    </div>

                    <div class="card-body">

                        <div class="row justify-content-center mt-4" id="auth-with-socials">
                            <div class="col">
                                <a href="/github/redirect" class="btn btn-dark btn-sm btn-block">
                                    <i class="fab fa-github fa-2x"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a href="/google/redirect" class="btn btn-info btn-sm text-white btn-block">
                                    <i class="fab fa-google fa-2x"></i>
                                </a>
                            </div>
                        </div>

                        <form action="/login" method="post">
                            <input type="hidden" name="_token" :value="csrf">

                            <div class="form-group row  mt-4">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Почта</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label ml-2" for="remember">
                                            Запомнить меня
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Войти
                                    </button>

                                    <a class="btn btn-link" href="/password/reset">
                                        Забыли пароль?
                                    </a>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf'
        ],
    }
</script>   