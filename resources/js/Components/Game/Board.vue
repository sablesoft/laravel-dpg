<!--suppress JSUnresolvedVariable -->
<script setup>
import {onMounted} from 'vue';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

onMounted(() => {
    setTimeout(function() {
        game.initCanvas(game.canvas);
        if (!game.canvas) {
            let options = {
                originX : 'left',
                originY : 'top',
                erasable: false
            };
            game.fb().setBackgroundImage(game.boardImage, game.renderAll.bind(game), options);
        }
        game.fb().on({
            'mouse:dblclick': function(event) {
                if (!event.target) {
                    return;
                }
                if (event.target.type === 'card') {
                    let o = event.target;
                    o.flip();
                    if (o.opened) {
                        game.showAside(o);
                    } else {
                        game.showInfo();
                    }
                }
            }
        });
        console.debug('Board mounted', game.fb());
    }, 200);
});
</script>

<template>
    <Canvas/>
</template>
