<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="col-lg-7 ml-4 mt-4" id="search-bar">
                <div class="col-lg-12 ml-4 mt-4">
                    <form action="/" method="post">
                        <div class="form-group d-flex border rounded">
                            <select class="custom-select w-25 robot-font" name="category">
                                <option class="robot-font" v-for="category in categories">{{ category.name }}</option>
                            </select>
                            <input class="form-control robot-font" name="searching" placeholder="| Type your request">
                            <button type="submit" class="search-btn">
                                <i class="fa fa-search text-muted"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'categories'
        ]
    }
</script>