<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ItemCard from "@/Components/ItemCard.vue";
import Pagination from "@/Components/Pagination.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps(["expenses", "date"]);

const date = props.date;

const form = useForm({
    date: date,
});

const month = date.split("-")[1];

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="mt-10 lg:px-96 px-8 flex justify-between items-center">
            <div>
                <form @change="
                    form.get(route('dashboard'), {
                        onSuccess: () => form.date,
                    })
                    ">
                    <input type="date" class="rounded-lg border border-transparent" v-model="form.date" />
                </form>
            </div>
            <div class="flex justify-center gap-x-5">
                <div>
                    <a :href="'/pdf/' + user.id + '?month=' + month"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf"
                            width="30" height="30" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                        </svg>
                        <span class="lg:text-sm">Monthly expenses</span>
                    </a>
                </div>
                <NavLink :href="route('expenses.create')">
                    Add expense
                </NavLink>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 overflow-hidden shadow-lg sm:rounded-lg rounded-lg mx-3">
                    <ItemCard v-for="expense in props.expenses.data" :key="expense.id" :expense="expense" />
                </div>
                <pagination class="mt-6 w-full flex justify-center flex-wrap mx-5" :links="expenses.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
