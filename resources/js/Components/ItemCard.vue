<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import dayjs from "dayjs";

defineProps(["expense"]);

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="lg:text-base text-sm">
        <h2 class="pl-6 pt-4 mb-5">{{ expense.payment.name }}</h2>
        <div class="text-gray-900 flex justify-between px-3 items-center">
            <p class="lg:pl-6">{{ expense.message }}</p>
            <p class="pr-3">{{ expense.store.name }}</p>
            <p class="pr-3">
                {{
                    dayjs(new Date(expense.created_at).toLocaleString()).format(
                        "MM/DD/YYYY",
                    )
                }}
            </p>
            <p class="">{{ expense.amount }} MXN</p>
            <a :href="'/pdf/' + user.id + '/' + expense.id" class="rounded-lg bg-gray-200 px-4 py-1" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf" width="40"
                    height="40" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                    <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                    <path d="M17 18h2" />
                    <path d="M20 15h-3v6" />
                    <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                </svg>
            </a>
        </div>
        <hr class="m-5 border-black" />
    </div>
</template>
