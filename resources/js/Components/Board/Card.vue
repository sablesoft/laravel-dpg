<script setup>
import {onMounted, ref} from "vue";

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
onMounted(() => {
    if (!props.card.object) {
        return;
    }
    tapped.value = !!props.card.object.tapped;
});
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
    .card-image>img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .card-desc {
        height: 320px;
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
        white-space: pre-line;
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
        <div class="card-content card-scope">
            {{ card.scope_name }}
        </div>
        <div class="card-content card-desc">
            {{ card.desc }}
        </div>
        <div class="card-content card-actions">
            <button v-if="card.object !== null && !tapped" @click="tap">Tap</button>
            <button v-if="card.object !== null && tapped" @click="untap">Untap</button>
        </div>
    </div>
</template>
