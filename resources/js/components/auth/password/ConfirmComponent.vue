<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Подтверждение пароля</div>

                    <div class="card-body">
                        Пожалуйста подтвердите ваш пароль прежде чем продолжить

                        <div class="col-lg-12 mt-4 fade show alert-dismissible alert bg-danger" v-if="errors">
                            <button class="close text-white robot-font font-weight-bold" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <strong class="text-white" v-for="error in errors">{{ error }}</strong>
                        </div>

                        <form method="POST" action="/password/confirm">
                            <input type="hidden" name="_token" :value="csrf">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Подтверждение пароля
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
            'csrf', 'errors'
        ]
    }
</script>