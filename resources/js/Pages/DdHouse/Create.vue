<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    code: null,
    name: null,
    cluster: null,
    region: null,
    district: null,
    thana: null,
    email: null,
    address: null,
    proprietor_name: null,
    contact_number: null,
    poc_name: null,
    poc_number: null,
    lifting_date: null,
    remarks: null,
})
</script>

<template>
    <Head title="Create House"/>

    <AuthenticatedLayout>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                Add New
            </h3>
            <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                Create new distribution house
            </p>
            <div class="mt-2 py-2 text-gray-500 dark:text-neutral-400 grid lg:grid-cols-2 gap-4">
                <TextInput label="code" v-model="form.code" :message="form.errors.code" mode="floating"/>
                <TextInput label="name" v-model="form.name" :message="form.errors.name" mode="floating"/>
                <TextInput label="cluster" v-model="form.cluster" :message="form.errors.cluster" mode="floating"/>
                <TextInput label="region" v-model="form.region" :message="form.errors.region" mode="floating"/>
                <TextInput label="district" v-model="form.district" :message="form.errors.district" mode="floating"/>
                <TextInput label="thana" v-model="form.thana" :message="form.errors.thana" mode="floating"/>
                <TextInput label="email" type="email" v-model="form.email" :message="form.errors.email" mode="floating"/>
                <TextInput label="address" v-model="form.address" :message="form.errors.address" mode="floating"/>
                <TextInput label="proprietor_name" v-model="form.proprietor_name" :message="form.errors.proprietor_name" mode="floating"/>
                <TextInput label="contact_number" v-model="form.contact_number" :message="form.errors.contact_number" mode="floating"/>
                <TextInput label="poc_name" v-model="form.poc_name" :message="form.errors.poc_name" mode="floating"/>
                <TextInput label="poc_number" v-model="form.poc_number" :message="form.errors.poc_number" mode="floating"/>
                <TextInput label="lifting_date" v-model="form.lifting_date" :message="form.errors.lifting_date" mode="floating"/>
                <TextInput label="remarks" v-model="form.remarks" :message="form.errors.remarks" mode="floating"/>
            </div>



            <button type="button" class="w-full md:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Button
            </button>

            <div>

                <button type="button" class="xl:w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    Button
                </button>
            </div>

            <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                Card link
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </a>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('house.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form class="grid md:grid-cols-2 gap-6" @submit.prevent="form.post(route('house.store'))">

                            <div>
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
