<template>
    <div class="col-lg-2 mt-4" id="social-links-sidebar">
        <div class="col-lg-12 text-right mt-3" v-for="link in resources">
            <a :href="link.link" class="text-muted">
                <i class="fab" :class="link.name"></i>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {resources: [
                {name: "fa-github", link: "https://github.com/rubyqorn"},
                {name: "fa-vk", link: "https://vk.com/rubyqorn"}
            ]}
        }
    } 
</script>