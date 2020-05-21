<template>
    <div class="container" id="header">
        <div class="col-lg-12 d-flex justify-content-end">
            <a href="https://github.com/rubyqorn" class="text-right">
                <i class="fab fa-github text-dark fa-2x"></i>
            </a>
        </div>
        <div class="col-lg-12 p-0 m-0">
            <p class="text-warning text-center display-4 ml-4">
                <i class="fa fa-bolt"></i>
            </p>
            <p class="display-4 text-center title">{{ title }}</p>
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