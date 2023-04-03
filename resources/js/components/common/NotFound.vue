<template>
    <div class="d-flex flex-column align-items-center justify-content-center" :style="'height: ' + height + ';'"> 
        <p v-if="icon" class="h3 font-weight-bolder">
            <img src="../../../../public/images/no-data.png" alt="No data" height="60" width="60" />   
        </p>
        
        <slot>
            <p class="font-weight-bold text-light-grey" style="font-size: 1rem;" v-html="message"></p>
        </slot>
    </div>
</template>

<script>
    export default {
        props: {
            icon: {
                default: 'far fa-layer-plus'
            },
            height: {
                default: 'auto'
            },
            message: {
                type: String,
                default: '<h6 class="text-center" style="font-size: 11px;">Sorry ! <br> It seems there is no data added in the system yet.</h6>'
            }
        }
    }
</script>