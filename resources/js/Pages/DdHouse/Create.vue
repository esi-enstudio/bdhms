<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SubmitButton from "@/Components/SubmitButton.vue";
import SelectInput from "@/Components/SelectInput.vue";

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
                <div class="flex flex-col sm:flex-row gap-3">
                    Add New

                    <div class="border-t sm:border-t-0 sm:border-s border-gray-200 dark:border-neutral-700"></div>

                    <Link :href="route('house.index')" class="inline-flex items-center gap-x-2 font-semibold rounded-lg text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                        Back To List
                    </Link>
                </div>
            </h3>
            <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                Create new distribution house
            </p>
            <form @submit.prevent="form.post(route('house.store'))">
                <div class="mt-2 py-2 text-gray-500 dark:text-neutral-400 grid lg:grid-cols-2 gap-4">
                    <TextInput label="code" v-model="form.code" :message="form.errors.code" mode="floating"/>
                    <TextInput label="name" v-model="form.name" :message="form.errors.name" mode="floating"/>
                    <TextInput label="cluster" v-model="form.cluster" :message="form.errors.cluster" mode="floating"/>
                    <TextInput label="region" v-model="form.region" :message="form.errors.region" mode="floating"/>
                    <TextInput label="district" v-model="form.district" :message="form.errors.district" mode="floating"/>
                    <TextInput label="thana" v-model="form.thana" :message="form.errors.thana" mode="floating"/>
                    <TextInput label="email" type="email" v-model="form.email" :message="form.errors.email" mode="floating"/>
                    <TextInput label="address" v-model="form.address" :message="form.errors.address" mode="floating"/>
                    <TextInput label="proprietor name" v-model="form.proprietor_name" :message="form.errors.proprietor_name" mode="floating"/>
                    <TextInput label="contact number" v-model="form.contact_number" :message="form.errors.contact_number" mode="floating"/>
                    <TextInput label="poc name" v-model="form.poc_name" :message="form.errors.poc_name" mode="floating"/>
                    <TextInput label="poc number" v-model="form.poc_number" :message="form.errors.poc_number" mode="floating"/>
                    <TextInput label="lifting date" v-model="form.lifting_date" :message="form.errors.lifting_date" mode="floating"/>
                    <TextInput label="remarks" v-model="form.remarks" :message="form.errors.remarks" mode="floating"/>
                    <SelectInput label="status" mode="normal"/>
                </div>

                <div class="mt-5">
                    <SubmitButton :disable="form.processing">Submit</SubmitButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
