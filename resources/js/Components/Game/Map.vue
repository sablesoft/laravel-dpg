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
    let json = dome.canvas ? dome.canvas.json : null;
    game.initFabric({
        fullHeight: dome.map_height,
        fullWidth: dome.map_width,
    }, json);
    if (!json) {
        game.fb().setBackgroundColor(game.fogColor, undefined);
        game.createAreaFabric(game.activeAreaId);
        game.addFog(dome.map_width, dome.map_height);
    }
    game.fb().on({
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
            console.log('selection:created', event);
            let o = event.selected[0];
            if (o.type === 'area') {
                o.selected(true);
                game.setActiveCard(o.card_id);
            }
        },
        'selection:updated': function(event) {
            console.log('selection:updated', event);
        },
        'selection:cleared': function(event) {
            console.log('selection:cleared', event);
            let o = event.deselected[0];
            if (o.type === 'area') {
                o.selected(false);
                game.setActiveCard(dome.scope_id);
            }
        }
    });
    setTimeout(function () {
        game.renderAll();
        game.freezeFog();
        game.setCanvasConfig(dome.canvas);
        console.debug('Map mounted', game.fb());
    }, 300);
});
</script>

<template>
    <Canvas/>
</template>
