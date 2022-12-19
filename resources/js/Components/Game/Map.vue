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
        game.fb().add(new fabric.Rect({
            originX: 'left',
            originY: 'top',
            fill: 'white',
            width: dome.map_height,
            height: dome.map_width,
            stroke: null,
            hasControls: false,
            hasBorders: false,
            lockMovementX: true,
            lockMovementY: true,
            lockScalingX: true,
            lockScalingY: true,
            lockRotation: true,
            hoverCursor: 'default',
            opacity: game.isMaster() ? 0.5 : 1,
        }));
        game.createAreaFabric(game.activeAreaId);
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
    game.setCanvasConfig(dome.canvas);
    setTimeout(function () {
        game.renderAll();
    }, 1000);
});
</script>

<template>
    <Canvas/>
</template>
