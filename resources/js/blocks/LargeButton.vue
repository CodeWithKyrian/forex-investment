<template>
    <div class="flex items-center justify-start text-lg text-gray-500 border border-gray-200 hover:text-gray-900 hover:border-gray-300 bg-none  h-16 rounded-md cursor-pointer my-4">
        <font-awesome-icon :icon="icon" class="mx-4" ></font-awesome-icon>
        <p>{{text}}</p>
    </div>
</template>

<script>
export default {
    props: {
        icon: String|Array,
        text: String
    }
}
</script>

<style>

</style>