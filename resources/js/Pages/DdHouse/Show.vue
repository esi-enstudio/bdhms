<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    ddHouse: Object,
})

const delHouse = (id, name) => {

    if (confirm(`Are you sure to delete "${name}" house?`))
    {
        router.delete(route('ddHouse.destroy', id));
    }
}

</script>

<template>
    <Head title="House Details" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    <span class="text-2xl italic">{{ `"${props.ddHouse.name}"` }}</span> House Details
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

                        <table>
                            <tr>
                                <td>DD Code</td>
                                <td>{{props.ddHouse.code}}</td>
                            </tr>
                            <tr>
                                <td>DD Name</td>
                                <td>{{props.ddHouse.name}}</td>
                            </tr>

                            <tr>
                                <td>Cluster</td>
                                <td>{{props.ddHouse.cluster}}</td>
                            </tr>

                            <tr>
                                <td>Region</td>
                                <td>{{props.ddHouse.region}}</td>
                            </tr>

                            <tr>
                                <td>District</td>
                                <td>{{props.ddHouse.district}}</td>
                            </tr>

                            <tr>
                                <td>Thana</td>
                                <td>{{props.ddHouse.thana}}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{props.ddHouse.email}}</td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td>{{props.ddHouse.address}}</td>
                            </tr>

                            <tr>
                                <td>Proprietor Name</td>
                                <td>{{props.ddHouse.proprietor_name}}</td>
                            </tr>

                            <tr>
                                <td>Proprietor Number</td>
                                <td>{{props.ddHouse.contact_number}}</td>
                            </tr>

                            <tr>
                                <td>POC Name</td>
                                <td>{{props.ddHouse.poc_name}}</td>
                            </tr>

                            <tr>
                                <td>POC Number</td>
                                <td>{{props.ddHouse.poc_number}}</td>
                            </tr>

                            <tr>
                                <td>Lifting Date</td>
                                <td>{{props.ddHouse.lifting_date}}</td>
                            </tr>

                            <tr>
                                <td>Remarks</td>
                                <td>{{props.ddHouse.remarks}}</td>
                            </tr>

                            <tr>
                                <td>Created Date</td>
                                <td>{{props.ddHouse.created}}</td>
                            </tr>

                            <tr>
                                <td>Last Update</td>
                                <td>{{props.ddHouse.updated}}</td>
                            </tr>

                            <tr>
                                <td>Disabled At</td>
                                <td>{{props.ddHouse.disabled}}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>{{props.ddHouse.status === 1 ? 'Active' : 'Inactive'}}</td>
                            </tr>

                        </table>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Edit -->
                            <Link :href="route('ddHouse.edit', ddHouse.id)" class="block hover:text-green-400">Edit</Link>

                            <!-- Delete -->
                            <button class="hover:text-red-500 hover:font-semibold" @click="delHouse(props.ddHouse.id, props.ddHouse.name)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
