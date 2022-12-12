<script setup>
import {onMounted, shallowRef} from "vue";
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";

const scaleRatio = shallowRef(1);
const canvasRef = shallowRef(null);
const canvasSize = {
    width: 986,
    height: 690
};
const log = (e) => {
    console.log(e);
};
const canvasMoveX = (value) => {
    let current = Number(canvasRef.value.style.left.slice(0, -2));
    canvasRef.value.style.left = current + value + 'px';
}
const canvasMoveY = (value) => {
    let current = Number(canvasRef.value.style.top.slice(0, -2));
    canvasRef.value.style.top = current + value + 'px';
}
const canvasMoveLeft = () => {
    canvasMoveX(-20);
}
const canvasMoveRight = () => {
    canvasMoveX(20);
}
const canvasMoveTop = () => {
    canvasMoveY(-20);
}
const canvasMoveBottom = () => {
    canvasMoveY(20);
}
const zoomInScene = () => {
    scaleRatio.value = scaleRatio.value * 1.1;
    zoomScene();
    console.log('Zoom In');
}
const zoomOutScene = () => {
    scaleRatio.value = scaleRatio.value * 0.9;
    zoomScene();
    console.log('Zoom Out');
}
const zoomResetScene = () => {
    scaleRatio.value = 1;
    zoomScene();
    console.log('Reset Zoom');
}
const zoomScene = () => {
    game.sceneCanvas.setDimensions({ width: game.width * scaleRatio.value, height: game.height * scaleRatio.value });
    game.sceneCanvas.setZoom(scaleRatio.value);
}
onMounted(() => {
    // todo
    setTimeout(function() {
        game.sceneCanvas = new fabric.Canvas(canvasRef.value);
        let scene = game.scenes[1];
        let options = scene.markers ? scene.markers.background : null;
        options = options ? options : {
            originX : 'left',
            originY : 'top',
        };
        game.sceneCanvas.setBackgroundImage(scene.image, game.sceneCanvas.renderAll.bind(game.sceneCanvas), options);
        game.sceneCanvas.renderAll();
        game.sceneCanvas.on({
            'selection:updated': log,
            'selection:created': log,
            'selection:cleared': log,
            'mouse:dblclick': log
        });
    }, 100);
});
</script>
<style scoped>
    #scene-canvas {
        overflow: hidden !important;
    }
</style>

<template>
    <button @click="zoomInScene">In</button> <button @click="zoomResetScene">Reset</button> <button @click="zoomOutScene">Out</button>
    <button @click="canvasMoveLeft">Left</button> <button @click="canvasMoveRight">Right</button>
    <button @click="canvasMoveTop">Top</button> <button @click="canvasMoveBottom">Bottom</button>
    <div id="scene-canvas" :style="{ height: game.height + 'px' }">
        <canvas ref="canvasRef" :width="game.width" :height="game.height"></canvas>
    </div>
</template>
