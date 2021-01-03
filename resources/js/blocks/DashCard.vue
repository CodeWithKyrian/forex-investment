<template>
    <div class="w-full flex items-center text-lg rounded-md cursor-pointer p-4 " :class="fill? color + ' border-none text-gray-300' : 'border border-gray-400 text-gray-500'">
        <font-awesome-icon :icon="icon" class="mr-6 text-3xl"></font-awesome-icon>
        <div>
            <h3 class="font-bold text-sm">{{title}}</h3>
            <p class=" uppercase text-xl font-bold pt-4" :class="fill? 'text-gray-100' : 'text-gray-600'">{{ content  }}</p> 
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        content: String, 
        icon: String,
        fill: Boolean,
        color: String
    }
}
</script>

<style>

</style>