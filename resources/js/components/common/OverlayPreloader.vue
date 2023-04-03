<template>
    <div 
        v-show="action">
        <div class="overlay">
            <div class="d-flex justify-content-center">
                <i class="fa fa-spinner fa-spin fa-3x"></i>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        opacity: 0.9;
        transform: translate(-50%, -50%);
        color: rgb(143, 142, 142);
    }
</style>
<script>
    export default {
        props: {
            action: {
                type: Boolean,
                default: false
            },
            fixed: {
                type: Boolean,
                default: false
            },
            classes: {
                type: [String, Array],
                default: ''
            },
        }
    }
</script>