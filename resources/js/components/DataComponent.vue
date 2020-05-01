<template>
    <div class="justify-content-center">
        <ul class="pagination">
            <li v-for="tag in laravelData.data" :key="tag.id">
                {{ tag.name }}
            </li>
        </ul> 
        <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>  
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                laravelData: {}
            }
        },
        created() {
            this.getResults()
        },
        methods: {
            getResults(page) {

                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.$http.get('/json-news?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        this.laravelData = data;
                    });

            }
        }
    }
</script>