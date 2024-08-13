<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ItemCard from "@/Components/ItemCard.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(["expenses", "date"]);

const date = props.date;

const form = useForm({
    date: date,
});
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
            <NavLink :href="route('expenses.create')"> Add expense </NavLink>
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
