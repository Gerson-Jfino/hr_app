<template>
    <div  class="grey">
        <navebar/>
        <main-details style="margin-top: 10px;"/>
    </div>
  </template>

<script>
import mainDetails from './layout/mainDetails.vue';
import navebar from './menu/navebar.vue';
export default {
    components: {navebar, mainDetails}

}
</script>

<style>

</style>
