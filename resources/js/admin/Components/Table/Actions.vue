<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import Edit from "@/admin/Components/Icon/Edit.vue";
import Trash from "@/admin/Components/Icon/Trash.vue";

defineProps({
    editLink: {
        type: String,
        default: () => "",
    },
    showEdit: {
        type: Boolean,
        default: () => true,
    },
    showDelete: {
        type: Boolean,
        default: () => true,
    },
});
</script>

<template>
    <div class="flex items-center space-x-2">
        <button v-if=" showEdit ">
            <Link :href=" editLink ">
            <Edit class="w-4 h-4 text-blue-500" />
            </Link>
        </button>
        <button v-if=" showDelete " @click=" $emit( 'deleteClicked', $event ) ">
            <Trash class="w-4 h-4 text-red-500" />
        </button>
    </div>
</template>
