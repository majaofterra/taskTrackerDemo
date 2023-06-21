<script setup>
    import { onMounted, ref } from 'vue';

    defineProps({
        options: {
            type: Array,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
    });

    defineEmits(['update:modelValue']);

</script>

<template>
    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm m-1" @input="$emit('update:modelValue', $event.target.value)">
        <option value="" selected></option>
        <option v-for="item in options" :value="item.id">{{item.name}}</option>
    </select>
</template>
