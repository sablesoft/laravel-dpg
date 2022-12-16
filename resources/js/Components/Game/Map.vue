<script setup>
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';
import {onMounted} from "vue";
// todo - draw current map with areas and markers
onMounted(() => {
    let dome = game.activeDome();
    if (!dome) {
        throw new Error('Active dome not found!');
    }
    // noinspection JSValidateTypes
    game.fabricMap = game.initFabric({
        fullHeight: dome.map_height,
        fullWidth: dome.map_width
    });
    game.setCanvasConfig(dome.canvas);
    console.debug('Map mounted');
});
</script>

<template>
    <Canvas/>
</template>
