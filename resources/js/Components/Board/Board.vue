<!--suppress JSUnresolvedVariable -->
<script setup>
import {onMounted, shallowReactive, shallowRef} from 'vue';
import {usePage} from "@inertiajs/inertia-vue3";
import { fabric } from 'fabric';
import './fabric.card';
import gameHandler from './game-handler';

import Card from '@/Components/Board/Card.vue';

const props = defineProps({
    game: { type: Object, required: true }
})

const locale = usePage().props.value.locale;
const canvasRef = shallowRef(null);
const canvas = shallowRef(null);
const canvasSize = {
    width: 1060,
    height: 690
};
const card = shallowReactive({
    name: null,
    image: null,
    scope_name: null,
    desc: null,
    object: null
});

const setCardInfo = function (model, object) {
    card.name = model.name;
    card.image = model.image;
    card.scope_name = model.scope_name;
    card.desc = model.desc;
    card.object = object ? object : null;
}
const setGameInfo = function() {
    setCardInfo(gameHandler.getGameCard());
}
const selectCards = (data) => {
    let object = data.selected[0];
    if (object.type !== 'card') {
        setGameInfo();
        return;
    }
    if (object.opened) {
        setCardInfo(object.model, object);
    } else {
        setGameInfo();
    }
}
const unselectCards = () => {
    setGameInfo();
}

const getHero = (options) => {
    return getCard(gameHandler.game.hero_id, options);
}
const getCard = (id, options) => {
    return new fabric.Card(gameHandler.getCard(id), options);
}

onMounted(() => {
    gameHandler.init(props.game, locale);
    canvas.value = new fabric.Canvas(canvasRef.value);
    canvas.value.setBackgroundImage(gameHandler.getBoardImage());
    const card = getHero({
        left: 350,
        top: 100,
        tapped: false
    });
    canvas.value.add(card);
    canvas.value.centerObject(card);
    canvas.value.on({
        'selection:updated': selectCards,
        'selection:created': selectCards,
        'selection:cleared': unselectCards,
        'mouse:dblclick': function(event) {
            if (!event.target) {
                return;
            }
            if (event.target.type === 'card') {
                let card = event.target;
                card.flip();
                if (card.opened) {
                    setCardInfo(card.model, card);
                } else {
                    setGameInfo();
                }
            }
        }
    });
    setGameInfo();
    // waiting images and re-render:
    setTimeout(function() {
        canvas.value.renderAll();
    }, 500);
});
</script>

<style scoped>
    .row {
        display: flex;
        padding: 1rem;
    }
    .board-column {
        flex: 76%;
    }
    .info-column {
        margin-left: 20px;
        flex: 24%;
    }
</style>

<template>
    <div class="mx-auto sm:px-6 lg:px-8 row">
        <div class="board-column bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <canvas ref="canvasRef" :width="canvasSize.width" :height="canvasSize.height"></canvas>
        </div>
        <div class="info-column bg-white shadow-sm sm:rounded-lg">
            <Card :card="card" />
        </div>
    </div>
</template>
