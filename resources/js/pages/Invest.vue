<template>
    <div class="w-full max-w-screen-xl py-12 px-6">
      invest
    </div>
</template>

<script>

export default {
  mounted(){
     this.$store.commit('changecurrPage', "invest")
  }
}
</script>

<style>

</style>