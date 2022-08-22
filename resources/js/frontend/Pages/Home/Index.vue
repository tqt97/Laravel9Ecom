<script setup>
// import {onMounted} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash/function";
import FrontendLayout from "@/frontend/Layouts/Frontend.vue";
import Container from "@/frontend/Components/Container.vue";
import Card from "@/frontend/Components/Card.vue";
import Post from "@/frontend/Components/Post.vue";
import Pagination from "@/frontend/Components/Pagination.vue";


import AddNew from "@/frontend/Components/AddNew.vue";
import Filters from "./Filters.vue";

import useDeleteItem from "@/frontend/Composables/useDeleteItem.js";
import useFilters from "@/frontend/Composables/useFilters.js";
import InfiniteScroll from '@/frontend/Components/InfiniteScroll.vue'

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
const {filters, isLoading, isFilled} = useFilters({
    filters: props.filters,
    routeResourceName: props.routeResourceName,
});
</script>

<script>
export default {
    props: ['items'],
    components: {
        InfiniteScroll,
    },
    data () {
        return {
            products: this.items
        }
    },
    mounted () {
        console.log(this.products)
        console.log(this.products.meta.current_page)
        console.log(this.products.next_page_url)
    },
    methods: {
        loadMoreProduct () {
            if (!this.products.next_page_url) {
                return
            }
            return axios.get('/?page=' + this.products.meta.current_page + 1)
                .then(resp => {
                    this.products = {
                        ...resp.data,
                        data: [
                            ...this.products.data, ...resp.data.data
                        ]
                    }
                })
        }
    },
}
</script>

<template>

    <Head :title=" title " />

    <FrontendLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template> -->

        <Container>
            <AddNew :show=" isFilled ">
                <template #filters>
                    <Filters v-model=" filters " :categories=" categories " />
                </template>
            </AddNew>

            <Card class="mt-4" :is-loading=" isLoading " no-padding>
                <section class="w-full grid grid-cols-3 gap-3 px-3">
                    <Post :items=" items " />
                    <!-- <InfiniteScroll> -->
                        <Post :items=" products.data " />
                    <!-- </InfiniteScroll> -->
                </section>
                <div v-if=" items.data.length === 0 "
                    class="w-full mx-auto text-center py-4">
                    <p>
                        No data available.
                    </p>
                </div>

            </Card>
            <!-- <div v-if=" items.meta.links.length > 3 " class="py-4">
                <Pagination :links=" items.meta.links " />
            </div> -->
        </Container>
    </FrontendLayout>


</template>
