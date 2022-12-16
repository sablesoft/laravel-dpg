<script setup>
import {onMounted} from "vue";
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

const log = (e) => {
    console.log(e);
};
onMounted(() => {
    // todo - draw active scene with markers
    setTimeout(function() {
        let scene = game.activeScene();
        if (!scene) {
            throw new Error('Active scene not found!');
        }
        fabric.Image.fromURL(scene.image, function(myImg) {
            let options = {
                originX : 'left',
                originY : 'top',
            };
            // noinspection JSValidateTypes
            game.fabricScene = game.initFabric({
                fullHeight: myImg.height,
                fullWidth: myImg.width
            });
            game.fabricScene.setBackgroundImage(myImg, game.fabricScene.renderAll.bind(game.fabricScene), options);
            game.setCanvasConfig(scene.canvas);
            game.fabricScene.on({
                'selection:updated': log,
                'selection:created': log,
                'selection:cleared': log,
                'mouse:dblclick': log
            });
        });
        console.debug('Scene mounted');
    }, 100);
});
</script>

<template>
    <Canvas/>
</template>
