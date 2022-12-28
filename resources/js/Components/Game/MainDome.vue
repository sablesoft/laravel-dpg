<script setup>
import { game } from "@/Components/Game/js/game";
import Canvas from '@/Components/Game/Canvas.vue';
import { onMounted } from "vue";
onMounted(() => {
    let dome = game.findDome(game.activeDomeId);
    game.initCanvas(dome.canvas, function(fc) {
        if (!dome.canvas) {
            dome.area_ids.forEach(function(id) {
                game.createAreaFabric(id);
            });
            game.createFog(dome.map_width, dome.map_height);
            fc.requestRenderAll();
        }
        setTimeout(function() {
            game.activateArea();
        }, 5000);
        console.debug('Map mounted', game.fb());
    });
});
</script>
<template>
    <Canvas/>
</template>
