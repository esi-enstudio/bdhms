<script setup>
defineProps({
    disable: Boolean,
})
</script>

<template>
    <button
        type="submit"
        :class="disable ? 'cursor-not-allowed opacity-50' : ''"
        class="text-white bg-green-600 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-400 dark:focus:ring-green-600" :disabled="disable"
    >
        <slot/>
    </button>
</template>

<style scoped lang="scss">

</style>
