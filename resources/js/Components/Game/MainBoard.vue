<!--suppress JSUnresolvedVariable -->
<script setup>
import { onMounted } from 'vue';
import { game } from "@/Components/Game/js/game";
import Canvas from '@/Components/Game/Canvas.vue';

onMounted(() => {
    let timeout = game.initiated ? 0 : 1000;
    setTimeout(function() {
        game.initCanvas(game.canvas, function(fc) {
            if (!game.canvas) {
                let options = {
                    originX : 'left',
                    originY : 'top',
                    erasable: false
                };
                fc.setBackgroundImage(game.boardImage, fc.renderAll.bind(fc), options);
                fc.requestRenderAll();
            }
            fc.on('mouse:dblclick', function(event) {
                if (!event.target) {
                    return;
                }
                if (event.target.type === 'card') {
                    let o = event.target;
                    o.flip();
                    if (o.opened) {
                        game.showAside(o);
                    } else {
                        game.showInfo();
                    }
                }
            });
            console.debug('Board mounted', fc);
        });
    }, timeout);
});
</script>
<template>
    <Canvas/>
</template>
