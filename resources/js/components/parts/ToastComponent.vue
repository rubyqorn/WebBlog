<template>
    <div id="toast-container">
        <div class="toast rounded" role="alert" data-delay="2000" data-autohide="false" id="toast">
            <div class="toast-header">
                <span class="text-warning"><i class="fa fa-bolt"></i></span>
                <strong class="robot-font ml-2 mr-auto text-muted"><small>WebBlog</small></strong>
                <button class="close ml-2 mb-1" data-dismiss="toast">
                    <span>&times;</span>
                </button>
            </div>
            <div class="toast-body text-muted robot-font">
                <span>{{ this.message }}</span>
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