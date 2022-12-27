<script setup>
import { onMounted } from "vue";
import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/js/game";
import Canvas from '@/Components/Game/Canvas.vue';

onMounted(() => {
    let scene = game.findScene(game.activeSceneId);
    game.initCanvas(scene.canvas, function (fc) {
        if (!scene.canvas) {
            fabric.Image.fromURL(scene.image, function(image) {
                let options = {
                    originX : 'left',
                    originY : 'top',
                    erasable: false,
                };
                fc.setBackgroundImage(image, game.renderAll.bind(game), options);
                game.createFog(image.width, image.height);
                fc.requestRenderAll();
            });
        }
        console.debug('Scene mounted', game.fb());
    });
});
</script>
<template>
    <Canvas/>
</template>
