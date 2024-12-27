<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({ddHouse: Object})

const form = useForm({
    code: props.ddHouse.code,
    name: props.ddHouse.name,
    cluster: props.ddHouse.cluster,
    region: props.ddHouse.region,
    district: props.ddHouse.district,
    thana: props.ddHouse.thana,
    email: props.ddHouse.email,
    address: props.ddHouse.address,
    proprietor_name: props.ddHouse.proprietor_name,
    contact_number: props.ddHouse.contact_number,
    poc_name: props.ddHouse.poc_name,
    poc_number: props.ddHouse.poc_number,
    lifting_date: props.ddHouse.lifting_date,
    disabled_at: props.ddHouse.disabled_at,
    status: props.ddHouse.status,
    remarks: props.ddHouse.remarks,
})
</script>

<template>
    <Head title="Update House"/>

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Update house
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-right">
                            <Link :href="route('ddHouse.index')" class="hover:text-green-400">Back to list</Link>
                        </div>

                        <form @submit.prevent="form.put(route('ddHouse.update', ddHouse.id))">

                            <div class="grid lg:grid-cols-2 gap-6">
                                <!-- DD Code -->
                                <div class="mb-3">
                                    <InputLabel for="code" value="DD Code" />

                                    <TextInput
                                        id="code"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.code"
                                        autofocus
                                        autocomplete="code"
                                    />

                                    <InputError class="mt-2" :message="form.errors.code" />
                                </div>

                                <!-- DD Name -->
                                <div class="mb-3">
                                    <InputLabel for="name" value="DD Name" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <!-- Cluster -->
                                <div class="mb-3">
                                    <InputLabel for="cluster" value="Cluster" />

                                    <TextInput
                                        id="cluster"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.cluster"
                                        autocomplete="cluster"
                                    />

                                    <InputError class="mt-2" :message="form.errors.cluster" />
                                </div>

                                <!-- Region -->
                                <div class="mb-3">
                                    <InputLabel for="region" value="Region" />

                                    <TextInput
                                        id="region"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.region"
                                        autocomplete="region"
                                    />

                                    <InputError class="mt-2" :message="form.errors.region" />
                                </div>

                                <!-- District -->
                                <div class="mb-3">
                                    <InputLabel for="district" value="District" />

                                    <TextInput
                                        id="district"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.district"
                                        autocomplete="district"
                                    />

                                    <InputError class="mt-2" :message="form.errors.district" />
                                </div>

                                <!-- Thana -->
                                <div class="mb-3">
                                    <InputLabel for="thana" value="Thana" />

                                    <TextInput
                                        id="thana"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.thana"
                                        autocomplete="thana"
                                    />

                                    <InputError class="mt-2" :message="form.errors.thana" />
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <InputLabel for="email" value="Email" />

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        autocomplete="email"
                                    />

                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <InputLabel for="address" value="Address" />

                                    <TextInput
                                        id="address"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.address"
                                        autocomplete="address"
                                    />

                                    <InputError class="mt-2" :message="form.errors.address" />
                                </div>

                                <!-- Proprietor Name -->
                                <div class="mb-3">
                                    <InputLabel for="proprietor_name" value="Proprietor Name" />

                                    <TextInput
                                        id="proprietor_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.proprietor_name"
                                        autocomplete="proprietor_name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.proprietor_name" />
                                </div>

                                <!-- Contact Number -->
                                <div class="mb-3">
                                    <InputLabel for="contact_number" value="Contact Number" />

                                    <TextInput
                                        id="contact_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.contact_number"
                                        autocomplete="contact_number"
                                    />

                                    <InputError class="mt-2" :message="form.errors.contact_number" />
                                </div>

                                <!-- POC Name -->
                                <div class="mb-3">
                                    <InputLabel for="poc_name" value="POC Name" />

                                    <TextInput
                                        id="poc_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.poc_name"
                                        autocomplete="poc_name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.poc_name" />
                                </div>

                                <!-- POC Number -->
                                <div class="mb-3">
                                    <InputLabel for="poc_number" value="POC Number" />

                                    <TextInput
                                        id="poc_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.poc_number"
                                        autocomplete="poc_number"
                                    />

                                    <InputError class="mt-2" :message="form.errors.poc_number" />
                                </div>

                                <!-- Lifting Date -->
                                <div class="mb-3">
                                    <InputLabel for="lifting_date" value="Lifting Date" />

                                    <TextInput
                                        id="lifting_date"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.lifting_date"
                                        autocomplete="lifting_date"
                                    />

                                    <InputError class="mt-2" :message="form.errors.lifting_date" />
                                </div>

                                <!-- Remarks -->
                                <div class="mb-3">
                                    <InputLabel for="remarks" value="Remarks" />

                                    <TextInput
                                        id="remarks"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.remarks"
                                        autocomplete="remarks"
                                    />

                                    <InputError class="mt-2" :message="form.errors.remarks" />
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <SelectInput label="Status" v-model="form.status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </SelectInput>
                                </div>
                            </div>

                            <PrimaryButton
                                class="mt-5"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Save Changes
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
