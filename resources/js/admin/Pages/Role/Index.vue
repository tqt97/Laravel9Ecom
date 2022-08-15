<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import {ref, watch, onMounted} from "vue";
import BreezeAuthenticatedLayout from "@/admin/Layouts/Authenticated.vue";
import Card from "@/admin/Components/Card.vue";
import Container from "@/admin/Components/Container.vue";
import Table from "@/admin/Components/Table/Table.vue";
import Td from "@/admin/Components/Table/Td.vue";
import Actions from "@/admin/Components/Table/Actions.vue";
import Button from "@/admin/Components/Button.vue";
import Modal from "@/admin/Components/Modal.vue";
import Input from "@/admin/Components/Input.vue";
import {Inertia} from "@inertiajs/inertia";


const props = defineProps({
    roles: {
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
});

const deleteModal = ref(false);
const itemToDelete = ref({});
const isDeleting = ref(false);

function showDeleteModal (item) {
    deleteModal.value = true;
    itemToDelete.value = item;
}
function handleDeleteItem () {
    Inertia.delete(route("admin.roles.destroy", {id: itemToDelete.value.id}), {
        onBefore: () => {
            isDeleting.value = true;
        },
        onSuccess: () => {
            deleteModal.value = false;
            itemToDelete.value = {};
        },
        onFinish: () => {
            isDeleting.value = false;
        }

    });
}

const filters = ref({
    name: "",
});
const fetchItemsHandler = ref(null);
function fetchItems () {
    Inertia.get(route("admin.roles.index"), filters.value, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    },);
}
onMounted(() => {
    filters.value = props.filters;
});
watch(filters, () => {
    clearTimeout(fetchItemsHandler.value);

    fetchItemsHandler.value = setTimeout(() => {
        fetchItems();
    }, 300);
}, {
    deep: true,
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
            <Card class="mb-4">
                <template #header>
                    Filter
                </template>
                <form class="grid grid-cols-4 gap-8">
                    <div>
                        <Label value="Name" />

                        <Input type="text" class="mt-1 block w-full"
                            v-model=" filters.name " />
                    </div>
                </form>
            </Card>
            <Button :href=" route( 'admin.roles.create' ) " class="mb-5">
                Add new role
            </Button>
            <Card>
                <Table :headers=" headers " :items=" roles ">
                    <template v-slot=" { item } ">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            <Actions :edit-link="
                                route( 'admin.roles.edit', { id: item.id } )
                            " @deleteClicked=" showDeleteModal( item ) " />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
    <Modal v-model=" deleteModal " :title=" `Delete ${ itemToDelete.name }` ">
        Are you sure you want to delete this item?

        <template #footer>
            <Button @click=" handleDeleteItem " :disabled=" isDeleting ">
                <span v-if=" isDeleting ">Deleting</span>
                <span v-else>Delete</span>
            </Button>
        </template>
    </Modal>
</template>
