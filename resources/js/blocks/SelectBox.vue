<template>
  <div class="my-6">
    <label :for="name" class="mb-2">{{label}}</label>
    <select :name="name"  class="w-full border mt-2 border-gray-200 bg-gray-200 rounded-sm px-4 py-3 outline-none transition-colors duration-150 ease-in-out focus:bg-white rounded">
        <option 
          v-for="option in options" 
          :key="option.bank_code"
          :selected="!!selected && selected == option.bank_code? 'selected': ''" 
          :value="option.bank_code">
            {{ option.name }}
        </option>
    </select>
  </div>
</template>

<script>
export default {
    props: {
        name: String,
        options: Array|Object,
        selected: String
    },
    computed: {
        label(){
            var strArray = this.name.split("_")
            var finalStr = ""
            strArray.forEach(str => {
                var fL = str.charAt(0);
                fL = fL.toUpperCase()
                str = str.substr(1);
                finalStr = finalStr + " " + fL + str
            });
            return finalStr.trim()
        }
    }
}
</script>

<style>

</style>