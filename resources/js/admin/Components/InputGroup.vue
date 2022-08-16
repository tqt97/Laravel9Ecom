<script setup>
import Input from "@/admin/Components/Input.vue";
import Label from "@/admin/Components/Label.vue";
import InputError from "@/admin/Components/InputError.vue";

defineProps({
    modelValue: {},
    type: {
        type: String,
        default: "text",
    },
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <div>
        <Label v-if="label" :value="label" />
        <Input
            :type="type"
            class="mt-1 block w-full"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            v-bind="$attrs"
        />
        <InputError v-if="errorMessage" class="mt-1" :message="errorMessage" />
    </div>
</template>
