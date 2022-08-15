<script setup>
import { onMounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Card from "@/admin/Components/Card.vue";
import Container from "@/admin/Components/Container.vue";
import Button from "@/admin/Components/Button.vue";

import BreezeCheckbox from "@/admin/Components/Checkbox.vue";
import BreezeInput from "@/admin/Components/Input.vue";
import BreezeInputError from "@/admin/Components/InputError.vue";
import BreezeLabel from "@/admin/Components/Label.vue";

const props = defineProps({
    edit: {
        type: Boolean,
        default: false,
    },
    role: {
        type: Object,
        default: () => ({}),
    },
    title: {
        type: String,
    },
});

const form = useForm({
    name: "",
});

const submit = () => {
    props.edit
        ? form.put(route("admin.roles.update", { id: props.role.id }))
        : form.post(route("admin.roles.store"));
};

onMounted(() => {
    if (props.edit) {
        form.name = props.role.name;
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
                    <div>
                        <BreezeLabel for="name" value="Name" />
                        <BreezeInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <BreezeInputError
                            class="mt-2"
                            :message="form.errors.name"
                        />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Button
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? "Saving" : "Save" }}
                        </Button>
                    </div>
                </form>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
