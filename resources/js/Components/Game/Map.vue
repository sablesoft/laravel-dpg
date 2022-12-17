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
    let json = dome.canvas ? dome.canvas.json : null;
    game.initFabric({
        fullHeight: dome.map_height,
        fullWidth: dome.map_width,
    }, json);
    if (!json) { // todo
        game.fabric().setBackgroundColor(game.fogColor, undefined);
        game.createAreaFabric(game.activeAreaId);
    }
    game.fabric().on({
        'mouse:over': function(event) {
            if (!event.target) {
                return;
            }
            let target = event.target;
            if (target.type === 'area') {
                console.log('Mouse over area');
                target.showName(true);
            }
        },
        'mouse:out': function(event) {
            if (!event.target) {
                return;
            }
            let target = event.target;
            if (target.type === 'area') {
                console.log('Mouse out area');
                target.showName(false);
            }
        },
        'selection:created': function(event) {
            console.log(event);
            let fabricObject = event.selected[0];
            fabricObject.selected(true);
            game.setActiveCard(fabricObject.card_id);
        },
        'selection:updated': function(event) {
            console.log('selection:created', event);
        },
        'selection:cleared': function(event) {
            let fabricObject = event.deselected[0];
            fabricObject.selected(false);
            game.setActiveCard(dome.scope_id);
        }
    });
    game.setCanvasConfig(dome.canvas);
    setTimeout(function () {
        game.renderAll();
    }, 1000);
});
</script>

<template>
    <Canvas/>
</template>
