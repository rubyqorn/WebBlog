<template>
    <div class="col-lg-3 mt-4" id="discussions-categories">
        <div class="card">
            <div class="card-header">
                <p class="h6 robot-font font-weight-bold">
                    Список категорий
                </p>
            </div>
            <div class="card-body">
                <ul class="list-group" v-for="category in categories">
                    <li class="list-group-item border-bottom">
                        <a :href="'/discussions-categories/'+ category.category_id" class="dark-color robot-font">
                            # {{ category.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'categories'
        ],
    }
</script>