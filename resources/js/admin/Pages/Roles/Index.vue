<script setup>
import BreezeAuthenticatedLayout from '@/admin/Layouts/Authenticated.vue';
import Card from '@/admin/Components/Card.vue';
import Container from '@/admin/Components/Container.vue';
import Table from '@/admin/Components/Table/Table.vue';
import Td from '@/admin/Components/Table/Td.vue';
import {Head} from '@inertiajs/inertia-vue3';

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
            <Card>
                <Table :headers=" headers " :items="items">
                    <tr class="border-b" v-for="item in items.data"
                        :key="item.id">
                        <Td>{{ item.name }}</Td>
                        <Td>{{ item.created_at_formatted }}</Td>
                        <Td>action</Td>
                    </tr>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
