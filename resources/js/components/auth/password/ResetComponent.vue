<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Изменить пароль</div>

                    <div class="card-body">
                        <div class="col-lg-12 mt-4 fade show alert-dismissible alert bg-danger" v-if="errors">
                            <button class="close text-white robot-font font-weight-bold" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <strong class="text-white" v-for="error in errors">{{ error }}</strong>
                        </div>

                        <form method="POST" action="/password/reset">
                            <input name="_token" type="hidden" :value="csrf">

                            <input name="token" type="hidden" :value="token">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Адрес эл. почты</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтверждение пароля</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Изменить пароль
                                    </button>
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
            'csrf', 'token', 'errors'
        ],
        mounted() {
            console.log(this.token);
        }
    }
</script>