<script setup>
import BreezeAuthenticatedLayout from '@/admin/Layouts/Authenticated.vue';
import Card from '@/admin/Components/Card.vue';
import Container from '@/admin/Components/Container.vue';
import {Head} from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <Container>
            <Card>
                Dashboard
            </Card>
        </Container>

    </BreezeAuthenticatedLayout>
</template>
