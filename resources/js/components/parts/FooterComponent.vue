<template>
    <div class="container mt-4 sticky-bottom">
        <div class="col-lg-12">
            <div class="row">
            
                <div class="col-lg-6">
                    <p class="robot-font text-muted">
                        <small>Webblog 2020</small>
                    </p>
                </div>

                <div class="col-lg-6 d-flex justify-content-end" v-for="link in links">
                    <a href="https://vk.com/rubyqorn" class="text-muted mr-1">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="https://github.com/rubyqorn" class="text-muted ml-1">
                        <i class="fab fa-github"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {links: {
                url: "https://vk.com/rubyqorn"
            }}
        }
    }
</script>