<script setup>

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    mode: String, // normal, floating
    label: String,
    type: {
        type: String,
        default: 'text',
    },
    placeholder: {
        type: String,
        default: '',
    },
    message: String,
})

</script>

<template>
    <!-- Normal Input -->
    <div v-if="mode === 'normal'" class="max-w-sm">
        <label
            :for="label"
            class="block text-sm font-medium mb-2 dark:text-white capitalize"
        >
            {{ label }}
        </label>

        <input
            v-model="model"
            :type="type"
            :id="label"
            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
            :placeholder="placeholder"
        >

        <small v-show="message" class="text-sm text-red-600 dark:text-red-400">
            {{ message }}
        </small>
    </div>
    <!-- End Normal Input -->

    <!-- Floating Input -->
    <div v-if="mode === 'floating'">
        <!-- Floating Select -->
        <div class="relative">
            <select v-model="model" class="peer p-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2">
                <option selected="">Open this select menu</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <label class="absolute top-0 start-0 p-4 h-full truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500 capitalize">{{ label }}</label>
        </div>
        <!-- End Floating Select -->
    </div>
    <!-- End Floating Input -->
</template>
