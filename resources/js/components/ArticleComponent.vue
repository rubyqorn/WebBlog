<template>
    
    <div class="col-lg-8 bg-grey mr-1 mt-1 mb-2" id="news-item">
        <div class="bg-ultra-dark p-4">
            <p class="robot-font text-success">
                # {{ category }}
            </p>
            <a :href="this.route" class="text-white robot-font ml-3">
                {{ title }}
            </a>

            <div class="d-flex mt-4">
                <div class="col-lg-8">
                    <p class="robot-font text-white">
                        Автор: {{ author }}
                    </p>
                </div>
                <div class="col-lg-4 justify-content-end">
                    <p class="text-white robot-font">
                        Дата: {{ date }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'category', 'title', 'author',
            'date', 'route'
        ]
    }
</script>