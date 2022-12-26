<script setup>
import { onMounted } from "vue";
import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

onMounted(() => {
    let scene = game.findScene(game.activeSceneId);
    if (!scene) {
        throw new Error('Active scene not found!');
    }
    game.initCanvas(scene.canvas);
    if (!scene.canvas) {
        let options = {
            originX : 'left',
            originY : 'top',
            erasable: false,
        };
        fabric.Image.fromURL(scene.image, function(image) {
            game.fb().setBackgroundImage(image, game.renderAll.bind(game), options);
            game.createMarkerFabric(48, {
                left: image.width / 2 + 200,
                top: image.height - 900,
                imageScale: 0.5
            });
            game.createFog(image.width, image.height);
        });
        game.renderAll();
    }

    console.debug('Scene mounted', game.fb());
});
</script>

<template>
    <Canvas/>
</template>
