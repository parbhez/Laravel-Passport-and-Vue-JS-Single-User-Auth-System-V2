<template>
    <table class="table table-bordered table-striped">
        <thead>
            <slot name="header">
                <tr>
                    <th 
                        v-for="(column, index) in headers" class="cursor-pointer" :key="index">
                        
                        <span>
                            {{ column }}
                        </span>
                        
                    </th>
                </tr>
            </slot>
        </thead>
        <tbody>    
            <slot></slot> 
        </tbody>
    </table>
</template>

<script>
    export default {
        props: {
            headers: {
                type: Array,
                default: []
            },
        },   
        
        
       
        methods: {   
            
            
            
        }
    }
</script>