<script setup>
import {onMounted, shallowRef} from "vue";
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";

const canvasRef = shallowRef(null);
const canvasSize = {
    width: 986,
    height: 690
};
const log = (e) => {
    console.log(e);
};
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

<template>
    <div id="scene-canvas">
        <canvas ref="canvasRef" :width="canvasSize.width" :height="canvasSize.height"></canvas>
    </div>
</template>
