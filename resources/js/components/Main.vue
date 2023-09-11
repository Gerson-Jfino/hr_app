<template>
    <div  class="grey">
        <navebar/>
        <main-details style="margin-top: 10px;"/>
        <loader/>
    </div>
  </template>

<script>
import mainDetails from './layout/mainDetails.vue';
import navebar from './menu/navebar.vue';
import Loader from './loader/Loader.vue';
export default {
    components: {navebar, mainDetails, Loader}

}
</script>

<style>

</style>
