<template>
    <div class="col-md-12">
        <div class="form-group">
  <label>{{ label }} </label>
   <textarea
       v-bind="$attrs"
       :placeholder="placeholder"
       class="form-control"
       rows="4"
       :value="modelValue"
       @input="$emit('update:modelValue', $event.target.value)"
       style="margin-top: 10px;"
   ></textarea>
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
