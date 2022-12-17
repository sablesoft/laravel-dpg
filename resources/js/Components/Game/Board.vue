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
        return game.setActiveCard(object.card_id);
    } else {
        return game.setActiveCard();
    }
}
const unselectCards = () => {
    return game.setActiveCard();
}

const getHero = (options) => {
    let id = game.heroIds[0];
    return game.createCardFabric(id, options);
}
onMounted(() => {
    // todo - draw current board with cards and decks
    setTimeout(function() {
        let options = {
            originX : 'left',
            originY : 'top'
        };
        fabric.Image.fromURL(game.boardImage, function(myImg) {
            // noinspection JSValidateTypes
            game.fabricBoard = game.initFabric({
                fullHeight: myImg.height,
                fullWidth: myImg.width
            });
            game.fabricBoard.setBackgroundImage(myImg, game.fabricBoard.renderAll.bind(game.fabricBoard), options);
            game.fabricBoard.preserveObjectStacking = true;
            const hero = getHero({
                left: 70,
                top: 530,
                opened: true
            });
            game.createCardFabric(hero.scope_id, {
                left: 40,
                top: 530,
                opened: true,
                tapped: true
            });
            hero.bringForward(true);

            game.fabricBoard.on({
                'selection:updated': selectCards,
                'selection:created': selectCards,
                'selection:cleared': unselectCards,
                'mouse:dblclick': function(event) {
                    if (!event.target) {
                        return;
                    }
                    if (event.target.type === 'card') {
                        let fabricCard = event.target;
                        fabricCard.flip();
                        if (fabricCard.opened) {
                            game.setActiveCard(fabricCard.card_id);
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
    console.debug('Board mounted');
});
</script>

<template>
    <Canvas/>
</template>
