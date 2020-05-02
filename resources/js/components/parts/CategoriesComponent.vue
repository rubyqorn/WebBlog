<template>
        
    <li class="nav-item">
        <a href="/" class="nav-link robot-font" :class="this.color">
            <small># {{ name }}</small>
        </a>
    </li>
        
</template>

<script>
    export default {
        props: [
            'name', 'color'
        ]
    }
</script>