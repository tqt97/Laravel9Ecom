<script setup>
import Checkbox from "@/admin/Components/Checkbox.vue";
// import Label from "@/admin/Components/Label.vue";
// import InputError from "@/admin/Components/InputError.vue";

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
    <!-- <div class="flex items-center">
        <Label>
            <Checkbox
                :value="value"
                @update:checked="$emit('update:checked', $event)"
                v-bind="$attrs"
            />
            {{ label }}
        </Label> -->
    <div class="flex items-center rounded">
        <!-- <input
            id=""
            type="checkbox"
            value=""
            name="bordered-checkbox"
            class="w-6 h-6 text-indigo-600 rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        /> -->
        <Checkbox
            :value="value"
            @update:checked="$emit('update:checked', $event)"
            v-bind="$attrs"
        />
        <label
            for="bordered-checkbox-1"
            class="py-3 ml-3 w-full text-sm font-bold text-gray-900"
        >
            {{ label }}
        </label>

        <!-- <InputError v-if="errorMessage" class="mt-1" :message="errorMessage" /> -->
        <div  v-if="errorMessage">
            <p class="text-sm text-red-600 mt-1">
                {{ errorMessage }}
            </p>
        </div>
    </div>
    <!-- </div> -->
</template>
