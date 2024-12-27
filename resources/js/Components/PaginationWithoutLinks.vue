<script setup>
const props = defineProps({
    houses: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div v-if="houses.from" class="lg:flex items-center justify-between mt-3 text-center space-y-6">
        <div>
            Showing
            <span class="font-bold">{{houses.from}}</span>
            to
            <span class="font-bold">{{houses.to}}</span>
            of
            <span class="font-bold">{{houses.total}}</span>
            results
        </div>

        <div class="items-center gap-2 inline-flex">
            <Link :href="houses.first" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">First</Link>
            <Link :href="houses.prev ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Prev</Link>
            <Link :href="houses.next ?? ''" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Next</Link>
            <Link :href="houses.last" class="border border-1 hover:bg-green-400 hover:text-white border-green-800 px-4 rounded-md">Last</Link>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
