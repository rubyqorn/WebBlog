<template>
    <div id="toast-container">
        <div class="toast" role="alert" data-delay="2000" data-autohide="false" id="toast">
            <div class="toast-header">
                <i class="fa fa-bolt text-warning"></i>
                <span class="ml-2 robot-font font-weight-bold mr-auto">
                    WebBlog
                </span>
                <button class="close ml-2 mb-1" data-dismiss="toast" id="hide-toast">
                    <span class="font-weight-bold">&times;</span>
                </button>
            </div>
            <div class="toast-body text-dark">
                <div class="col-lg-12">
                    <span class="robot-font font-weight-bold">{{ this.message }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'message'
        ]
    }
</script>