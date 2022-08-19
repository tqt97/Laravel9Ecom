<script setup>
import { ref, watch } from "vue";

import Card from "@/admin/Components/Card.vue";
import InputGroup from "@/admin/Components/InputGroup.vue";
import SelectGroup from "@/admin/Components/SelectGroup.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        default: () => ({}),
    },
    categories: Array,
});
const emits = defineEmits(["update:modelValue"]);
const filters = ref({ ...props.modelValue });

watch(
    filters,
    () => {
        emits("update:modelValue", filters.value);
    },
    {
        deep: true,
    }
);
</script>

<template>
    <Card class="mb-4">
        <template #header> Filters </template>

        <form class="grid grid-cols-3 gap-8">
            <InputGroup label="Name" v-model="filters.name" />
            <SelectGroup
                label="Category"
                v-model="filters.parentId"
                :items="categories"
            />
            <SelectGroup
                label="Status"
                v-model="filters.active"
                :items="[
                    { id: 1, name: 'Active' },
                    { id: 0, name: 'Inactive' },
                ]"
            />
        </form>
    </Card>
</template>
