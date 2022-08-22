<script setup>
import {ref} from 'vue';
import BreezeApplicationLogo from '@/frontend/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/frontend/Components/Dropdown.vue';
import BreezeDropdownLink from '@/frontend/Components/DropdownLink.vue';
import BreezeNavLink from '@/frontend/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/frontend/Components/ResponsiveNavLink.vue';
import Alert from "@/frontend/Components/Alert.vue";
import {Link} from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <Alert />
        <div class="min-h-screen bg-gray-50">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center space-x-6">
                                <Link :href=" route( 'home.index' ) ">
                                <BreezeApplicationLogo
                                    class="block h-9 w-auto text-red-500" />
                                </Link>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce01 ">T</span>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce02">u</span>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce03">ấ</span>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce04">n</span>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce05">T</span>
                                <span
                                    class="font-bold text-cyan-500 shadow-sm text-lg animate-bounce06">Q</span>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">


                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if=" $slots.header ">
                <div class="container mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-4">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
