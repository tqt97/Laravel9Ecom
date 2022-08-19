<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, watch } from "vue";
import kebabCase from "lodash/kebabCase";
import replace from "lodash/replace";
import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Container from "@/admin/Components/Container.vue";
import Card from "@/admin/Components/Card.vue";
import Button from "@/admin/Components/Button.vue";
import InputGroup from "@/admin/Components/InputGroup.vue";
import SelectGroup from "@/admin/Components/SelectGroup.vue";
import CheckboxGroup from "@/admin/Components/CheckboxGroup.vue";
const props = defineProps({
    edit: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
    item: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
    rootCategories: {
        type: Array,
        required: true,
    },
});
const form = useForm({
    name: "",
    slug: "",
    active: true,
    parentId: "",
});
watch(
    () => form.name,
    (name) => {
        // if (!props.edit) {
            form.slug = kebabCase(replace(name, /&./, "and"));
        // }
    }
);
const submit = () => {
    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  id: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`));
};
onMounted(() => {
    if (props.edit) {
        form.name = props.item.name;
        form.slug = props.item.slug;
        form.active = props.item.active;
        form.parentId = props.item.parent_id;
    }
});
</script>

<template>
    <Head :title="title" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-6">
                        <InputGroup
                            label="Name"
                            v-model="form.name"
                            :error-message="form.errors.name"
                            required
                        />

                        <InputGroup
                            label="Slug"
                            v-model="form.slug"
                            :error-message="form.errors.slug"
                            required
                        />

                        <SelectGroup
                            label="Parent Category"
                            v-model="form.parentId"
                            :items="rootCategories"
                            :error-message="form.errors.parentId"
                        />

                        <div class="mt-6">
                            <CheckboxGroup
                                label="Active"
                                v-model:checked="form.active"
                            />
                        </div>
                    </div>

                    <div class="mt-4">
                        <Button :disabled="form.processing">
                            {{ form.processing ? "Saving..." : "Save" }}
                        </Button>
                    </div>
                </form>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
