<script setup>
import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Card from "@/admin/Components/Card.vue";
import Container from "@/admin/Components/Container.vue";
import Table from "@/admin/Components/Table/Table.vue";
import Td from "@/admin/Components/Table/Td.vue";
import Actions from "@/admin/Components/Table/Actions.vue";
import Button from "@/admin/Components/Button.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
    },
    items: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head title="Roles" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Role
            </h2>
        </template>

        <Container>
            <Button :href="route('admin.roles.create')" class="mb-5"> Add new role </Button>
            <Card>
                <Table :headers="headers" :items="roles">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            <Actions :edit-link="route('admin.roles.edit',{id:item.id})"/>
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
