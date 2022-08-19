<script setup>
import Checkbox from "@/admin/Components/Checkbox.vue";
import Label from "@/admin/Components/Label.vue";
import InputError from "@/admin/Components/InputError.vue";
defineProps({
    value: {},
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
        <Label>
            <Checkbox
                :value="value"
                @update:checked="$emit('update:checked', $event)"
                v-bind="$attrs"
            />
            {{ label }}
        </Label>

        <InputError v-if="errorMessage" class="mt-1" :message="errorMessage" />
    </div>
</template>
