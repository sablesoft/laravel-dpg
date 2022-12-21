<script setup>
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';
import {onMounted} from "vue";
import {fabric} from "fabric-with-erasing";
// todo - draw current map with areas and markers
onMounted(() => {
    let dome = game.activeDome();
    if (!dome) {
        throw new Error('Active dome not found!');
    }
    game.initFabric({
        fullHeight: dome.map_height,
        fullWidth: dome.map_width,
    }, dome.canvas);
    let json = dome.canvas ? dome.canvas.json : null;
    if (!json) {
        game.fb().setBackgroundColor(game.fogColor, undefined);
        game.createAreaFabric(game.activeAreaId);
        game.addFog(dome.map_width, dome.map_height);
    }
    setTimeout(function () {
        game.renderAll();
        game.freezeFog();
        game.setCanvasConfig();
        console.debug('Map mounted', game.fb());
    }, 300);
});
</script>

<template>
    <Canvas/>
</template>
