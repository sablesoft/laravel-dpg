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
    if (!dome.canvas) {
        // todo - create from scratch
        game.fb().setBackgroundColor(game.fogColor, undefined);
        game.createAreaFabric(game.activeAreaId);
        setTimeout(function() {
            game.createMarker(80, {
                left: 3160,
                top: 3900
            });
            game.createMarker(83, {
                left: 3298,
                top: 3941
            });
            game.createMarker(98, {
                left: 3100,
                top: 3850
            });
        }, 300);
        game.addFog(dome.map_width, dome.map_height);
    }
    setTimeout(function () {
        game.renderAll();
        game.freezeFog();
        console.debug('Map mounted', game.fb());
    }, 300);
});
</script>

<template>
    <Canvas/>
</template>
