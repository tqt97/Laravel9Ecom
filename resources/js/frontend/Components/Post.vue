<script setup>


defineProps({
    items: {
        type: Object,
        default: () => ({}),
    },
});
</script>
<template>
    <article class="shadow my-4 rounded-md border hover:shadow-md"
        v-for="item in items.data" :key=" item.id ">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75 rounded-md">
            <img
                src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
        </a>
        <div class="bg-white  justify-start p-6">
            <a href=""
                class="text-3xl font-bold hover:text-gray-700 pb-4">{{ item.name }}</a>
            <p href="#" class="text-sm pb-3">
                By <a href="#"
                    class="font-semibold hover:text-gray-800">{{ item.creator.name }}</a>,
                Published on
                April 25th, 2020
            </p>
            <a href="#" class="pb-6">
                Description
            </a>
            <br>
            <a href="#"
                class="uppercase text-gray-800 hover:text-black">Continue
                Reading <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </article>

</template>
