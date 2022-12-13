<script setup>
import {onMounted} from "vue";
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

const log = (e) => {
    console.log(e);
};
onMounted(() => {
    // todo - draw current scene with markers
    setTimeout(function() {
        let scene = game.scenes[1];
        let options = scene.markers ? scene.markers.background : null;
        options = options ? options : {
            originX : 'left',
            originY : 'top',
        };
        fabric.Image.fromURL(scene.image, function(myImg) {
            let canvas = document.getElementsByTagName('canvas')[0];
            game.fabricScene = new fabric.Canvas(canvas);
            game.fabricScene.fullHeight = myImg.height;
            game.fabricScene.fullWidth = myImg.width;
            game.fabricScene.setBackgroundImage(myImg, game.fabricScene.renderAll.bind(game.fabricScene), options);
            game.fabricScene.on({
                'selection:updated': log,
                'selection:created': log,
                'selection:cleared': log,
                'mouse:dblclick': log
            });
        });
        console.log('Scene mounted');
    }, 100);
});
</script>

<template>
    <Canvas/>
</template>
