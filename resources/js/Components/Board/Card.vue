<script setup>
import { ref } from "vue";

    const props = defineProps({
        card: { type: Object, required: true }
    });

    const tap = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        if (object.tapped) {
            return;
        }
        object.tap();
        props.card.tapped = true;
    };
    const untap = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        if (!object.tapped) {
            return;
        }
        object.untap();
        props.card.tapped = false;
    };
    const forward = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        object.bringForward(true);
        object.canvas.requestRenderAll();
    };
    const backward = () => {
        if (!props.card.object) {
            return;
        }
        const object = props.card.object;
        object.sendBackwards(true);
        object.canvas.requestRenderAll();
    };
    const save = () => {
        console.log('TODO SAVE');
    };
    const load = () => {
        console.log('TODO LOAD');
    }
</script>
<style scoped>
    .card {
        text-align: center;
    }
    .card-name {
        font-weight: bold;
    }
    .card-scope {
        height: 80px;
        line-height: 80px;
        margin: 15px;
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
        margin-left: 15px;
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
            <button @click="forward">{{ __('Forward') + '  >  ' }}</button>
            <button v-if="!card.tapped" @click="tap">{{ __('Tap') }}</button>
            <button v-if="card.tapped" @click="untap">{{ __('Untap') }}</button>
            <button @click="backward">{{ '  <  ' + __('Backward') }}</button>
        </div>
        <div v-if="!card.object" class="card-content card-actions">
            <button @click="save">{{ __('Save') }}</button>
            <button @click="load">{{ __('Load') }}</button>
        </div>
    </div>
</template>
