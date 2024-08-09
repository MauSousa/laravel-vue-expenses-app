<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    message: "",
    store_id: "Store",
    amount: "",
    payment_id: "Payment",
});

defineProps(["payments", "stores"]);
</script>

<template>

    <Head title="Create Expense" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add a new expense
            </h2>
        </template>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="
                form.post(route('expenses.store'), {
                    onSuccess: () => form.reset(),
                })
                ">
                <div class="mb-2">
                    <label for="bankName" class="block mb-2 text-sm font-medium">Select an option</label>
                    <select id="bankName" v-model="form.payment_id"
                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Payment</option>
                        <option v-for="payment in payments" :value="payment.id">
                            {{ payment.name }}
                        </option>
                    </select>
                    <InputError :message="form.errors.bankName" class="mt-2" />
                </div>

                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-black">Message</label>

                    <textarea v-model="form.message" placeholder="What did you buy?" id="message"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    <InputError :message="form.errors.message" class="mt-2" />
                </div>
                <div class="my-2">
                    <label for="storeName" class="block mb-2 text-sm font-medium">Select an option</label>
                    <select id="storeName" v-model="form.store_id"
                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Store</option>
                        <option v-for="store in stores" :value="store.id">
                            {{ store.name }}
                        </option>
                    </select>
                    <InputError :message="form.errors.storeName" class="mt-2" />
                </div>

                <div>
                    <label for="amount" class="block mb-2 text-sm font-medium text-black">Amount</label>
                    <input type="text" id="amount" v-model="form.amount"
                        class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="$699" />
                    <InputError :message="form.errors.amount" class="mt-2" />
                </div>

                <PrimaryButton class="mt-4">Save</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
