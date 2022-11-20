<script setup>
import { fabric } from 'fabric';
import { ref, onMounted } from 'vue';

const canvasRef = ref(null);
const canvas = ref(null);
const size = {
    width: innerWidth - 100,
    height: innerHeight - 170
};
const cardWidth = 100;
const cardRation = 1.4;

onMounted(() => {
    canvas.value = new fabric.Canvas(canvasRef.value);
    const rect = new fabric.Rect({
        left: 100,
        top: 100,
        fill: 'red',
        width: cardWidth,
        height: cardWidth * cardRation
    });
    canvas.value.add(rect);
})

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
