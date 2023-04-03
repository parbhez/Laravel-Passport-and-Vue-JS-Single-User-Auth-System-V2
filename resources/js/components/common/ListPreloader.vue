<template>
    <div class="list-preloader" v-show="action">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
        	action: {
                type: Boolean,
                default: false
            },
            classes: {
                type: [String, Array],
                default: ''
            },
        },
        mounted() {
            
        },
        methods: {
            
        },
    }
</script>

<style scoped>
.lds-ripple,
.lds-ripple div {
  box-sizing: border-box;
}
.lds-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    opacity: 0.9;
    transform: translate(-50%, -50%);
    color: rgb(143, 142, 142);
    display: inline-block;
    width: 100px;
    height: 100px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid currentColor;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 8px;
    height: 8px;
    opacity: 1;
  }
  100% {
    top: 0;
    left: 0;
    width: 80px;
    height: 80px;
    opacity: 0;
  }
}

</style>