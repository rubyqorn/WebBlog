<template>
    <div class="col-lg-6 h-100">
        <div class="col-lg-12 border rounded p-3 mt-4">

            <div class="d-flex">
                <img src="assets/img/default.png" class="avatar">
                <p class="robot-font ml-2">
                    <small>John Doe</small>
                </p>
                <p class="text-muted ml-4 robot-font">
                    <small>
                        создано в категории 
                        <span class="text-info"># PHP</span>
                        20 апр
                    </small>
                </p>
            </div>

            <div class="col-lg-12 mt-4 border rounded p-3">
                <a href="" class="text-muted robot-font">
                    This is a title
                </a>
            </div>

            <div class="row mt-3">
                <div class="col-lg-9 justify-content-start">
                    <p class="text-muted robot-font">
                        <small>
                            Количество ответов
                            <span class="text-info border-bottom">
                                10
                            </span>
                        </small>
                    </p>
                </div>
                <div class="col-lg-3 text-right justify-content-end">
                    <a href="/" class="btn btn-dark btn-sm robot-font">
                        Ответить
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                discussions: []
            }
        }
    }
</script>