<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ItemCard from "@/Components/ItemCard.vue";

const props = defineProps(["expenses", "today"]);

const date = props.today;

const form = useForm({
    today: date,
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

        <!-- <div class="mt-10 flex flex-row-reverse xl:mr-96 lg:mr-20 md:mr-10 mr-9 md:end-0 end-0"> -->
        <div class="mt-10 lg:px-96 px-8 flex justify-between items-center">
            <div>
                <form @change="
                    form.post(route('expenses.filter_date'), {
                        onSuccess: () => form.today,
                    })
                    ">
                    <input type="date" class="rounded-lg" v-model="form.today" name="today" />
                </form>
            </div>
            <NavLink :href="route('expenses.create')"> Add expense </NavLink>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg rounded-lg mx-3">
                    <ItemCard v-for="expense in props.expenses" :key="expense.id" :expense="expense" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
