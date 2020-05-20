<template>
    <div class="col-lg-2 mt-4" id="ask-question-btn">
        <button data-toggle="modal" data-target="#ask-question" class="btn btn-dark btn-block text-uppercase">
            <small class="robot-font">
                Задать вопрос
            </small>
        </button>

        <div class="modal fade" id="ask-question" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="font-weight-bold robot-font">
                            Задать вопрос
                        </h4>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="/discussions" method="post" enctype="multipart/form-data">
                            <input name="_token" type="hidden" :value="csrf">

                            <div class="form-group">
                                <label class="robot-font control-label">
                                    <span class="text-info">*</span> Категория:
                                </label>
                                <select name="categories" class="custom-select">
                                    <option name="category" v-for="category in categories">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title" class="control-label robot-font">
                                    <span class="text-info">*</span> Заголовок:
                                </label>
                                <input type="text" class="form-control" name="title" placeholder="Заголовок обсуждения">
                                <p class="text-muted">
                                    <small>* Минимальное количество символов - 3</small>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="control-label robot-font">
                                   <span class="text-info">*</span> Вопрос:
                                </label>
                                <textarea name="question" cols="30" rows="10" class="form-control" placeholder="Подробное описание того что вас интересует"></textarea>
                                <p class="text-muted">
                                    <small>* Минимальное количество символов - 40</small>
                                </p>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="file">
                                <label for="file" class="custom-file-label">
                                    <i class="fas fa-camera">
                                        <span class="ml-2 robot-font">
                                            <small>Выбрать фото</small>
                                        </span>
                                    </i>
                                </label>
                            </div>
                            <div class="form-group mt-4">
                                <button class="btn btn-dark btn-sm float-right robot-font">
                                    Задать
                                </button>
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
            'categories', 'csrf'
        ]
    }
</script>