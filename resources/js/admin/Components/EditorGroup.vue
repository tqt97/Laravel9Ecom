<script setup>
import { ref } from "vue";
import Editor from "@tinymce/tinymce-vue";

import Input from "@/admin/Components/Input.vue";
import Label from "@/admin/Components/Label.vue";
import InputError from "@/admin/Components/InputError.vue";
defineProps({
    modelValue: {},
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});
const config = ref({
    height: 300,
});
</script>

<template>
    <div>
        <Label v-if="label" :value="label" />
        <editor
            api-key="hu39m4mn8mj0uy7bx6ubsxdf2nuq6k3peda90m28kn6xotn6"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            :init="config"
            v-bind="$attrs"
        />
        <InputError v-if="errorMessage" class="mt-1" :message="errorMessage" />
    </div>
</template>
