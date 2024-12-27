<script setup>
const props = defineProps({
    houses: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div v-if="houses.links.length > 0" class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
        <div class="text-sm text-gray-600 dark:text-neutral-400">
            Showing
            <span class="font-semibold text-gray-800 dark:text-neutral-200">{{houses.from}}</span>
            to
            <span class="font-semibold text-gray-800 dark:text-neutral-200">{{houses.to}}</span>
            of
            <span class="font-semibold text-gray-800 dark:text-neutral-200">{{houses.total}}</span>
            results
        </div>

        <div class="items-center gap-2 inline-flex">
            <Link :href="houses.first_page_url" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                First
            </Link>

            <Link :href="houses.prev_page_url ?? '#'" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Prev
            </Link>

            <Link :href="houses.next_page_url ?? '#'" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Next
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </Link>

            <Link :href="houses.last_page_url" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Last
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </Link>
        </div>
    </div>
</template>


<!--        <div>-->
<!--            <Component-->
<!--                :is="link.url ? 'Link' : 'span'"-->
<!--                v-for="link in houses.links"-->
<!--                :href="link.url"-->
<!--                v-html="link.label"-->
<!--                class="px-2 border border-green-400 rounded-md mx-1 hover:bg-green-400 hover:text-white"-->
<!--                :class="{'text-gray-400 border-gray-400 hover:bg-gray-400 cursor-not-allowed' : !link.url, 'font-bold text-white bg-green-400 rounded-md' : link.active}"-->
<!--            />-->
<!--        </div>-->
