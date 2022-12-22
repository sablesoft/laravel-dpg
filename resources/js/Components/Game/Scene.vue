<script setup>
import { onMounted } from "vue";
import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

onMounted(() => {
    // todo - draw active scene with markers
    let scene = game.activeScene();
    if (!scene) {
        throw new Error('Active scene not found!');
    }
    fabric.Image.fromURL(scene.image, function(image) {
        game.initFabric({
            fullHeight: image.height,
            fullWidth: image.width
        }, scene.canvas);
        if (!scene.canvas) {
            let options = {
                originX : 'left',
                originY : 'top',
                erasable: false,
            };
            game.fb().setBackgroundImage(image, game.renderAll.bind(game), options);
            game.createMarker(48, {
                left: image.width / 2 + 200,
                top: image.height - 900,
                imageScale: 0.5
            });
            game.addFog(image.width, image.height);
        }
        setTimeout(function () {
            game.renderAll();
            game.freezeFog();
            console.debug('Scene mounted', game.fb());
        }, 300);
    });
});
</script>

<template>
    <Canvas/>
</template>
