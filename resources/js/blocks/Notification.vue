<template>
  <div class="text-lg text-gray-500 border border-gray-200 bg-none rounded-md cursor-pointer p-4">
    <h3 class="text-blue-800 font-bold text-xl">{{title}}</h3>
    <p class="">{{content}}</p>
    <p class="text-gray-600 uppercase text-sm font-bold">{{date}}</p>
  </div>
</template>

<script>
export default {
    props: {
        title: String,
        content: String,
        date: String
    }
}
</script>

<style>

</style>