<!--suppress JSUnresolvedVariable -->
<script setup>
import { fabric } from 'fabric';
import './fabric.card';
import {ref, onMounted, computed} from 'vue';

const props = defineProps({
    game: { type: Object, required: true }
})

const canvasRef = ref(null);
const canvas = ref(null);
const size = {
    width: innerWidth - 380,
    height: innerHeight - 100
};

const cardBack = computed(() => {
    return '/storage/' + props.game.book.cards_back;
});
const boardImage = computed(() => {
    return '/storage/' + props.game.board_image;
});

onMounted(() => {
    canvas.value = new fabric.Canvas(canvasRef.value);
    canvas.value.setBackgroundImage(boardImage.value);

    // scope:
    fabric.Image.fromURL(cardBack.value, function(oImg) {
        oImg.scale(0.3);
        oImg.set('left', 180);
        oImg.set('top', 65);
        oImg.set('angle', 90);
        oImg.set('selectable', false);
        oImg.set('hasControls', false);
        oImg.set('lockMovementY', true);
        oImg.set('lockMovementX', true);
        oImg.set('hoverCursor', 'pointer');
        oImg.set('id', 'scope');
        canvas.value.add(oImg);
    });

    // deck:
    fabric.Image.fromURL(cardBack.value, function(oImg) {
        oImg.scale(0.3);
        oImg.set('left', 70);
        oImg.set('top', 40);
        oImg.set('selectable', false);
        oImg.set('hasControls', false);
        oImg.set('lockMovementY', true);
        oImg.set('lockMovementX', true);
        oImg.set('hoverCursor', 'pointer');
        oImg.set('id', 'deck');
        canvas.value.add(oImg);
    });
    const cardModel = {
        name: 'Test'
    };
    const card = new fabric.Card(cardModel, {
        left: 350,
        top: 100,
    });
    canvas.value.add(card);
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
    .info-column>.title {
        text-align: center;
        padding: 7px;
        font-weight: bold;
        border-bottom: 1px solid black;
    }
</style>

<template>
    <div class="mx-auto sm:px-6 lg:px-8 row">
        <div class="board-column bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <canvas ref="canvasRef" :width="size.width" :height="size.height"></canvas>
        </div>
        <div class="info-column bg-white shadow-sm sm:rounded-lg">
            <div class="title">
                {{ game.name }}
            </div>
        </div>
    </div>
</template>
