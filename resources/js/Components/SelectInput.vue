<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    options: {
        type: Array,
        required: true,
    },
});

defineEmits(['update:options']);

</script>

<template>
    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" @input="$emit('update:modelValue', $event.target.value)">
        <option value="" disabled >Select option</option>
        <option v-for="item in options" :value="item.id" >{{item.name}}</option>
    </select>
</template>
