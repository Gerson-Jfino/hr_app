<template>
    <div >
        <navebar/>
        <div class="mt-6">
                <router-view></router-view>
        </div>
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
