<script setup>
defineProps(['value']);
</script>

<template>
    <label class="block font-bold text-sm text-gray-700 mb-2">
        <span v-if="value">{{ value }} :</span>
        <span v-else><slot /></span>
    </label>
</template>
