<script setup>
import {ref, watch} from "vue";

import Card from "@/admin/Components/Card.vue";
import InputGroup from "@/admin/Components/InputGroup.vue";
import SelectGroup from "@/admin/Components/SelectGroup.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        default: () => ({}),
    },
    roles: Array,
});

const emits = defineEmits(["update:modelValue"]);

const filters = ref({...props.modelValue});

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

        <form class="grid grid-cols-4 gap-8">
            <div>
                <InputGroup label="Name" v-model=" filters.name " />
                <InputGroup label="Email" v-model=" filters.email "
                    type="email" />
                <SelectGroup label="Role" v-model=" filters.roleId "
                    :items=" roles " />
            </div>
        </form>
    </Card>
</template>
