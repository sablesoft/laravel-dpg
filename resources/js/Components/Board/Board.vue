<script setup>
import { fabric } from 'fabric';
import './fabric.card';

import {ref, onMounted, computed} from 'vue';
import {usePage} from "@inertiajs/inertia-vue3";

const canvasRef = ref(null);
const canvas = ref(null);
const size = {
    width: innerWidth - 60,
    height: innerHeight - 110
};

const cardBack = computed(() => {
    return '/storage/' + usePage().props.value.game.book.cards_back;
});
const boardImage = computed(() => {
    return '/storage/' + usePage().props.value.game.board_image;
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
    // setTimeout(function() {
    //     canvas.value.item(0).animate('top', 400, {
    //         onChange: canvas.value.renderAll.bind(canvas.value),
    //         duration: 1000,
    //         easing: fabric.util.ease.easeOutBounce
    //     });
    // }, 1000);
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

<template>
    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div style="display: flex; justify-content: center; align-items: center;">
                    <canvas ref="canvasRef" :width="size.width" :height="size.height"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>
