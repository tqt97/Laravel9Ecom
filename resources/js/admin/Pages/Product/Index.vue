<script setup>
import { onMounted, ref, watch } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Container from "@/admin/Components/Container.vue";
import Card from "@/admin/Components/Card.vue";
import Table from "@/admin/Components/Table/Table.vue";
import Td from "@/admin/Components/Table/Td.vue";
import Actions from "@/admin/Components/Table/Actions.vue";
import Button from "@/admin/Components/Button.vue";
import Modal from "@/admin/Components/Modal.vue";
import Label from "@/admin/Components/Label.vue";
import Input from "@/admin/Components/Input.vue";
import AddNew from "@/admin/Components/AddNew.vue";
import YesNoLabel from "@/admin/Components/YesNoLabel.vue";
import Filters from "./Filters.vue";

import useDeleteItem from "@/admin/Composables/useDeleteItem.js";
import useFilters from "@/admin/Composables/useFilters.js";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
    can: Object,
    categories: Array,
});
const {
    deleteModal,
    itemToDelete,
    isDeleting,
    showDeleteModal,
    handleDeleteItem,
} = useDeleteItem({
    routeResourceName: props.routeResourceName,
});
const { filters, isLoading,isFilled } = useFilters({
    filters: props.filters,
    routeResourceName: props.routeResourceName,
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
            <AddNew :show="isFilled">
                <Button
                    v-if="can.create"
                    :href="route(`admin.${routeResourceName}.create`)"
                    >Add New</Button
                >

                <template #filters>
                    <Filters v-model="filters" :categories="categories" />
                </template>
            </AddNew>

            <Card class="mt-4" :is-loading="isLoading" no-padding>
                <Table :headers="headers" :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.name }}
                            </div>
                        </Td>
                        <Td class="text-center">
                            {{ item.cost_price }}
                        </Td>
                        <Td class="text-center">
                            {{ item.price }}
                        </Td>
                        <Td class="text-center">
                            <YesNoLabel :active="item.show_on_slider" />
                        </Td>
                        <Td class="text-center">
                            <YesNoLabel :active="item.featured" />
                        </Td>
                        <Td class="text-center">
                            <YesNoLabel :active="item.active" />
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            {{ item.creator.name }}
                        </Td>
                        <Td class="text-center">
                            <Actions
                                :edit-link="
                                    route(`admin.${routeResourceName}.edit`, {
                                        id: item.id,
                                    })
                                "
                                :show-edit="item.can.edit"
                                :show-delete="item.can.delete"
                                @deleteClicked="showDeleteModal(item)"
                            />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>

    <Modal v-model="deleteModal" :title="`Delete ${itemToDelete.name}`">
        Are you sure you want to delete this item?

        <template #footer>
            <Button @click="handleDeleteItem" :disabled="isDeleting">
                <span v-if="isDeleting">Deleting ...</span>
                <span v-else>Delete</span>
            </Button>
        </template>
    </Modal>
</template>
