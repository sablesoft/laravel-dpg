<!--suppress JSUnresolvedVariable -->
<script setup>
import {onMounted} from 'vue';
import { fabric } from 'fabric';
import { game } from "@/Components/Game/game";
import Canvas from '@/Components/Game/Canvas.vue';

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
    return game.setActiveCard();
}

const getHero = (options) => {
    let id = game.heroIds[0];
    return game.createCardObject(id, options);
}
onMounted(() => {
    // todo - draw current board with cards and decks
    setTimeout(function() {
        let options = {
            originX : 'left',
            originY : 'top'
        };
        fabric.Image.fromURL(game.boardImage, function(myImg) {
            let canvas = document.getElementsByTagName('canvas')[0];
            game.fabricBoard = new fabric.Canvas(canvas);
            game.fabricBoard.fullHeight = myImg.height;
            game.fabricBoard.fullWidth = myImg.width;
            game.fabricBoard.setBackgroundImage(myImg, game.fabricBoard.renderAll.bind(game.fabricBoard), options);
            game.fabricBoard.preserveObjectStacking = true;
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
            game.fabricBoard.add(heroScope);
            heroScope.tap();
            game.fabricBoard.add(hero);

            game.fabricBoard.on({
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
            game.setCanvasConfig(game.canvas);
            game.fabricBoard.renderAll();
        });
    }, 100);
});
</script>

<template>
    <Canvas/>
</template>
