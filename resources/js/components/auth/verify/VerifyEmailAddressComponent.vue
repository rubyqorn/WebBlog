<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Подтвердите адрес эл. почты</div>

                    <div class="card-body">
                        Прежде чем обрабатывать, проверьте свою почту с верификационной ссылкой 
                        Если вы не получили письмо
                        <form class="d-inline" method="POST" action="/verification/resend">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Получить письмо</button>.
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
        ]
    }
</script>