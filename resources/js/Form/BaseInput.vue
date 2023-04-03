<template>
     <div class="col-md-12">
        <div class="form-group">
   <label>{{ label }} <span style="color:red;">*</span></label>
    <input
        v-bind="$attrs"
        :placeholder="placeholder"
        class="form-control"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        style="margin-top: 10px;"
    >
</div>
</div>
</template>

<script>
    export default {
        props:{
            label:{
                type: String,
                defautl: ''
            },
            placeholder:{
                type: String,
                defautl: ''
            },
            modelValue:{
                type: [String, Number],
                default: ''
            }
        }
    }
</script>
