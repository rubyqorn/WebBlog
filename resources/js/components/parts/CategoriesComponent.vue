<template>
        
    <li class="nav-item">
        <a :href="route" class="nav-link robot-font" :class="this.color" id="category_link">
            # {{ name }}
        </a>
    </li>

</template>

<script>
    export default {
        props: [
            'name', 'color', 'route'
        ]
    }
</script>