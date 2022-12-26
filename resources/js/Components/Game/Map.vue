<script setup>
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';
import {onMounted} from "vue";
onMounted(() => {
    let dome = game.findDome(game.activeDomeId);
    game.initCanvas(dome.canvas, {}, 5000);
    if (!dome.canvas) {
        // todo - create from scratch
        dome.area_ids.forEach(function(id) {
            game.createAreaFabric(id);
        });
        setTimeout(function() {
            game.createMarkerFabric(80, {
                left: 3160,
                top: 3900
            });
            game.createMarkerFabric(83, {
                left: 3298,
                top: 3941
            });
            game.createMarkerFabric(98, {
                left: 3100,
                top: 3850
            });
        }, 300);
        game.createFog(dome.map_width, dome.map_height);
        setTimeout(function () {
            game.renderAll();
        }, 1000);
    }
    console.debug('Map mounted', game.fb());
});
</script>

<template>
    <Canvas/>
</template>
