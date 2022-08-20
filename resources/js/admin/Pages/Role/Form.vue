<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";

import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Card from "@/admin/Components/Card.vue";
import Container from "@/admin/Components/Container.vue";
import Button from "@/admin/Components/Button.vue";
import BreezeInput from "@/admin/Components/Input.vue";
import BreezeInputError from "@/admin/Components/InputError.vue";
import BreezeLabel from "@/admin/Components/Label.vue";
import Permissions from "./Permissions.vue";

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
    permissions: {
        type: Array,
    },
});

const form = useForm({
    name: props.item.name ?? "",
});

const submit = () => {
    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  id: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`));
};
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
                            {{ form.processing ? "Saving..." : "Save" }}
                        </Button>
                    </div>
                </form>
            </Card>
        </Container>
        <Permissions
            v-if="edit"
            class="mt-6"
            :role="item"
            :permissions="permissions"
        />
    </BreezeAuthenticatedLayout>
</template>
