<script setup>
import { ref } from "vue";

    const props = defineProps({
        card: { type: Object, required: true }
    });

    const tapped = ref(null);
    const tap = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        if (object.tapped) {
            return;
        }
        object.tap();
        tapped.value = true;
    }
    const untap = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        if (!object.tapped) {
            return;
        }
        props.card.object.untap();
        tapped.value = false;
    }
</script>
<style scoped>
    .card {
        text-align: center;
    }
    .card-name {
        font-weight: bold;
    }
    .card-content {
        margin-top: 10px;
    }
    .card-image {
        height: 250px;
    }
    .scope-image {
        height: 80px;
        margin: 15px;
    }
    .scope-image>img {
        height: 80px;
        margin: 10px;
    }
    .card-image>img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 0.5rem;
    }
    .card-desc {
        height: 250px;
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
        white-space: pre-line;
        overflow: auto;
    }
    .card-actions {
        background-color: antiquewhite;
        font-weight: bold;
        font-size: 18px;
        padding-bottom: 5px;
        padding-top: 5px;
        margin-top: 0;
    }
    .card-actions>button {
        margin-left: 10px;
    }
</style>
<template>
    <div class="card shadow-sm sm:rounded-lg">
        <div class="card-content card-name">
            {{ card.name }}
        </div>
        <div class="card-content card-image">
            <img :src="card.image" alt="">
        </div>
        <div v-if="!card.scope_image" class="card-content card-name card-scope">
            {{ card.scope_name }}
        </div>
        <div v-if="card.scope_image" class="card-content card-image scope-image">
            <img :src="card.scope_image" :alt="card.scope_name" :title="card.scope_name">
        </div>
        <div class="card-content card-desc">
            {{ card.desc }}
        </div>
        <div v-if="card.object !== null" class="card-content card-actions">
            <button v-if="!card.tapped" @click="tap">{{ __('Tap') }}</button>
            <button v-if="card.tapped" @click="untap">{{ __('Untap') }}</button>
        </div>
    </div>
</template>
