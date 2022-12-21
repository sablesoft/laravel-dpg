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
        setTimeout(function() {
            game.createMarker(80, {
                left: 3160,
                top: 3900
            });
            game.createMarker(83, {
                left: 3260,
                top: 4000
            });
        }, 300);
        game.addFog(dome.map_width, dome.map_height);
    }
    setTimeout(function () {
        game.fb().getObjects().forEach(function(o) {
            if (o.type === 'area') {
                o.sendBackwards(true);
            }
            if (o.type === 'marker' && game.isMaster()) {
                o.unlockMovement();
            }
        });
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
