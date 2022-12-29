<script setup>
import { game } from "@/Components/Game/js/game";
import Canvas from '@/Components/Game/Canvas.vue';
import { onMounted } from "vue";
onMounted(() => {
    let dome = game.findDome(game.activeDomeId);
    game.initCanvas(dome.canvas, function(fc) {
        if (!dome.canvas) {
            let options = {
                originX : 'left',
                originY : 'top',
                opacity: dome.area_ids.length ? 0.4 : 1,
                erasable: false,
            };
            fc.setBackgroundImage(dome.image, game.renderAll.bind(game), options);
            setTimeout(function() {
                dome.area_ids.forEach(function(id) {
                    game.createAreaFabric(id);
                });
                game.createFog(dome.map_width, dome.map_height);
                setTimeout(function() {
                    game.activateArea();
                    console.debug('Dome mounted', game.fb());
                }, 5000);
            }, 3000);
        } else {
            setTimeout(function() {
                game.activateArea();
                console.debug('Dome mounted', game.fb());
            }, 5000);
        }
    });
});
</script>
<template>
    <Canvas/>
</template>
