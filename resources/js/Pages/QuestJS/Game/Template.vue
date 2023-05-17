<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Screen from 'questjs-core/components/Screen.vue';
import * as questjs from "questjs-core";
// import "./settings";
// import "./code";
// import "./data";
import {onMounted} from "vue";
onMounted(() => {
    questjs.run();
});
</script>
<style>
    @import "questjs-core/assets/css/sans-serif.css";
    /*@import "questjs-core/assets/css/serif.css";*/
</style>
<template>
    <Head :title="questjs.settings.title" />
    <Screen :questjs="questjs"/>
</template>
