<!--suppress JSUnresolvedVariable -->
<script setup>
import {onMounted} from 'vue';
import { fabric } from 'fabric-with-erasing';
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
    // todo
    let id = game.heroIds[0];
    return game.createCardFabric(id, options);
}
onMounted(() => {
    // todo - draw current board with cards and decks
    setTimeout(function() {
        fabric.Image.fromURL(game.boardImage, function(image) {
            let options = {
                originX : 'left',
                originY : 'top',
                erasable: false
            };
            // noinspection JSValidateTypes
            game.initFabric({
                fullHeight: image.height,
                fullWidth: image.width
            });
            game.fb().setBackgroundImage(image, game.renderAll.bind(game), options);
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

            game.fb().on({
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
            game.renderAll();
            console.debug('Board mounted', game.fb());
        });
    }, 100);
});
</script>

<template>
    <Canvas/>
</template>
