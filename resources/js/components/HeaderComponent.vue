<template>
    <div class="container" id="header">
        <div class="p-4">
            <div class="col-lg-12 d-flex justify-content-end">
                <a href="https://github.com/rubyqorn">
                    <i class="fab fa-github text-dark fa-2x"></i>
                </a>
            </div>
            <div class="col-lg-12">
                <p class="text-warning text-center ml-4 display-2">
                    <i class="fa fa-bolt"></i>
                </p>
                <p class="display-3 text-center title">{{ title }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       props: [
           'title'
       ]
    }
</script>