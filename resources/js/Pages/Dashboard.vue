<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/vue3";
import ItemCard from "@/Components/ItemCard.vue";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="mt-10 flex flex-row-reverse xl:mr-96 lg:mr-20 md:mr-10 mr-9 md:end-0 end-0">
            <NavLink :href="route('test')" :active="route().current('test')">
                Add expense
            </NavLink>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ItemCard />
                    <ItemCard />
                    <ItemCard />
                    <ItemCard />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
