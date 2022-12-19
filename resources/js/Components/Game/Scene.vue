<script setup>
import {onMounted} from "vue";
import { fabric } from 'fabric-with-erasing';
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
        let json = scene.canvas ? scene.canvas.json : null;
        fabric.Image.fromURL(scene.image, function(image) {
            game.initFabric({
                fullHeight: image.height,
                fullWidth: image.width
            }, json);
            if (!json) {
                let options = {
                    originX : 'left',
                    originY : 'top',
                    erasable: false,
                };
                game.fb().setBackgroundImage(image, game.renderAll.bind(game), options);
                game.fb().add(new fabric.Rect({
                    originX: 'left',
                    originY: 'top',
                    fill: 'white',
                    width: image.width,
                    height: image.height,
                    stroke: null,
                    hasControls: false,
                    hasBorders: false,
                    lockMovementX: true,
                    lockMovementY: true,
                    lockScalingX: true,
                    lockScalingY: true,
                    lockRotation: true,
                    hoverCursor: 'default',
                    opacity: game.isMaster() ? 0.5 : 1,
                }));
            }
            game.fb().on({
                'selection:updated': log,
                'selection:created': log,
                'selection:cleared': log,
                'mouse:dblclick': log,
                'erasing:end': function(a, b) {
                    console.log('erasing:end', a, b);
                }
            });
            game.setCanvasConfig(scene.canvas);
            game.renderAll();
            console.debug('Scene mounted', game.fb());
        });
    }, 100);
});
</script>

<template>
    <Canvas/>
</template>
