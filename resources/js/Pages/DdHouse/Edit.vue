<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SubmitButton from "@/Components/SubmitButton.vue";

const props = defineProps({house: Object})

const form = useForm({
    code: props.house.code,
    name: props.house.name,
    cluster: props.house.cluster,
    region: props.house.region,
    district: props.house.district,
    thana: props.house.thana,
    email: props.house.email,
    address: props.house.address,
    proprietor_name: props.house.proprietor_name,
    contact_number: props.house.contact_number,
    poc_name: props.house.poc_name,
    poc_number: props.house.poc_number,
    lifting_date: props.house.lifting_date,
    disabled_at: props.house.disabled_at,
    status: props.house.status,
    remarks: props.house.remarks,
})
</script>

<template>
    <Head title="Update House"/>

    <AuthenticatedLayout>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                Add New
            </h3>
            <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                Create new distribution house
            </p>
            <form @submit.prevent="form.put(route('house.update', props.house.id))">
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

                <div class="mt-5">
                    <SubmitButton :disable="form.processing">Save Changes</SubmitButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
