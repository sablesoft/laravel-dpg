<!--suppress JSUnresolvedVariable -->
<script setup>
import Card from '@/Components/Board/Card.vue';
import {ref, onMounted, computed, reactive} from 'vue';
import {usePage} from "@inertiajs/inertia-vue3";

import { fabric } from 'fabric';
import './fabric.card';
import gameHandler from './game-handler';

const props = defineProps({
    game: { type: Object, required: true }
})

const locale = usePage().props.value.locale;
const canvasRef = ref(null);
const canvas = ref(null);
const size = {
    width: 1060,
    height: 690
};

const showCard = ref(false);
const card = reactive({
    name: null,
    image: null,
    scope_name: null,
    desc: null
});

const cardBack = computed(() => {
    return '/storage/' + props.game.book.cards_back;
});
const boardImage = computed(() => {
    return '/storage/' + props.game.board_image;
});
const setCard = function (model) {
    card.name = model.name;
    card.image = model.image;
    card.scope_name = model.scope_name;
    card.desc = model.desc;
}
const showGameInfo = function() {
    setCard(gameHandler.getGameCard());
}

const selectCards = (data) => {
    let object = data.selected[0];
    if (object.type !== 'card') {
        showGameInfo();
        return;
    }
    setCard(object.model);
}
const unselectCards = () => {
    showGameInfo();
}

onMounted(() => {
    gameHandler.init(props.game, locale);
    canvas.value = new fabric.Canvas(canvasRef.value);
    canvas.value.setBackgroundImage(boardImage.value);
    //
    // // scope:
    // fabric.Image.fromURL(cardBack.value, function(oImg) {
    //     oImg.set('left', 180);
    //     oImg.set('top', 65);
    //     oImg.set('angle', 90);
    //     oImg.set('selectable', false);
    //     oImg.set('hasControls', false);
    //     oImg.set('lockMovementY', true);
    //     oImg.set('lockMovementX', true);
    //     oImg.set('hoverCursor', 'pointer');
    //     oImg.set('id', 'scope');
    //     canvas.value.add(oImg);
    // });
    //
    // // deck:
    // fabric.Image.fromURL(cardBack.value, function(oImg) {
    //     oImg.set('left', 70);
    //     oImg.set('top', 40);
    //     oImg.set('selectable', false);
    //     oImg.set('hasControls', false);
    //     oImg.set('lockMovementY', true);
    //     oImg.set('lockMovementX', true);
    //     oImg.set('hoverCursor', 'pointer');
    //     oImg.set('id', 'deck');
    //     canvas.value.add(oImg);
    // });


    const cardModel = gameHandler.getHero();
    const card = new fabric.Card(cardModel, {
        left: 350,
        top: 100,
    });
    canvas.value.add(card);
    canvas.value.on({
        'selection:updated': selectCards,
        'selection:created': selectCards,
        'selection:cleared': unselectCards
    });
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
            <canvas ref="canvasRef" :width="size.width" :height="size.height"></canvas>
        </div>
        <div class="info-column bg-white shadow-sm sm:rounded-lg">
            <Card :card="card"/>
        </div>
    </div>
</template>
