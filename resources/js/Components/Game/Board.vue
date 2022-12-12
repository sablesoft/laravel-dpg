<!--suppress JSUnresolvedVariable -->
<script setup>
import {onMounted, shallowRef} from 'vue';
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";

const canvasRef = shallowRef(null);
const canvasSize = {
    width: 986,
    height: 690
};

const selectCards = (data) => {
    let object = data.selected[0];
    if (object.type !== 'card') {
        return game.setActiveCard();
    }
    if (object.opened) {
        return game.setActiveCard(object.model.id);
    } else {
        return game.setActiveCard();
    }
}
const unselectCards = () => {
    console.debug('Unselect cards');
    return game.setActiveCard();
}

const getHero = (options) => {
    let id = game.heroIds[0];
    return game.createCardObject(id, options);
}
onMounted(() => {
    setTimeout(function() {
        game.boardCanvas = new fabric.Canvas(canvasRef.value);
        game.boardCanvas.preserveObjectStacking = true;
        game.boardCanvas.setBackgroundImage(game.boardImage, game.boardCanvas.renderAll.bind(game.boardCanvas), {
            originX : 'left',
            originY : 'top',
            width : game.boardCanvas.width,
            height : game.boardCanvas.height
        });
        const hero = getHero({
            left: 70,
            top: 530,
            opened: true
        });
        const heroScope = game.createCardObject(hero.model.scope_id, {
            left: 40,
            top: 530,
            opened: true
        });
        game.boardCanvas.add(heroScope);
        heroScope.tap();
        game.boardCanvas.add(hero);

        game.boardCanvas.on({
            'selection:updated': selectCards,
            'selection:created': selectCards,
            'selection:cleared': unselectCards,
            'mouse:dblclick': function(event) {
                if (!event.target) {
                    return;
                }
                if (event.target.type === 'card') {
                    let card = event.target;
                    card.flip();
                    if (card.opened) {
                        game.setActiveCard(card.model.id);
                    } else {
                        game.setActiveCard();
                    }
                }
            }
        });
        game.boardCanvas.renderAll();
    }, 100);
});
</script>

<template>
    <div id="board-canvas">
        <canvas ref="canvasRef" :width="canvasSize.width" :height="canvasSize.height"></canvas>
    </div>
</template>
