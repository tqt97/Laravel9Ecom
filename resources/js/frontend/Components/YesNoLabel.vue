<script setup>
import Button from "@/admin/Components/Button.vue";
defineProps({
    active: Boolean,
});
</script>

<template>
    <Button :color="active ? 'green' : 'red'" small>
        {{ active ? "Yes" : "No" }}
    </Button>
</template>
