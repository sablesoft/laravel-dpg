import { reactive } from 'vue';
import './fabric.card';
import {fabric} from "fabric";

export const game = reactive({
    // game info:
    info: null,
    // active card data:
    activeCard: {
        id: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null,
        tapped: false
    },
    // board and card back images:
    boardImage: null,
    cardsBack: null,
    // game global quest:
    questId: null,
    // game heroes:
    heroIds: null,
    // game custom cards:
    cardIds: null,
    // game custom decks:
    deckIds: null,
    // open entities:
    openDomeIds: null,
    openLandIds: null,
    openAreaIds: null,
    openSceneIds: null,
    openDeckIds: null,
    openCardIds: null,
    // data storage:
    books: null,
    cards: null,
    decks: null,
    domes: null,
    lands: null,
    areas: null,
    scenes: null,
    // fabric canvases:
    fabricBoard: null,
    fabricMap: null,
    fabricScene: null,
    // tabs:
    mainTab: 'Board',
    asideTab: 'Card',
    // main tab size:
    width: null,
    height: null,
    canvasMoveStep: 20,
    canvasScaleStep: 0.1,
    init(data, options) {
        for (const [key, value] of Object.entries(data)) {
            this[key] = value;
        }
        this.activeCard = this.info;
        this.activeCard.id = null;
        this.activeCard.tapped = false;
        this.width = options.width;
        this.height = options.height;
    },
    setActiveCard(id = null) {
        if (!id) {
            this.activeCard = this.info;
            return true;
        }
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        this.activeCard = this.cards[id];
        console.debug('Active card: ', this.activeCard);

        return true;
    },
    activeCardTap() {
        this.activeCard.tapped = this.cardTap(this.activeCard.id);
    },
    activeCardUntap() {
        this.activeCard.tapped = !this.cardUntap(this.activeCard.id);
    },
    activeCardForward() {
        return this.cardForward(this.activeCard.id);
    },
    activeCardBackward() {
        return this.cardBackward(this.activeCard.id);
    },
    cardTap(id) {
        console.debug('Tap card: ' + id);
        return this._cardObject(id).tap();
    },
    cardUntap(id) {
        console.debug('Untap card: ' + id);
        return this._cardObject(id).untap();
    },
    cardForward(id) {
        let co = this._cardObject(id);
        console.debug('Forward card: ' + id);
        co.bringForward(true);
        co.canvas.requestRenderAll();
    },
    cardBackward(id) {
        let co = this._cardObject(id);
        console.debug('Backward card: ' + id);
        co.sendBackwards(true);
        co.canvas.requestRenderAll();
    },
    createCardObject(id, options) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }

        return this.cards[id].obj = new fabric.Card(this.cards[id], options);
    },
    showMap() {
        this.mainTab = 'Map';
    },
    showScene() {
        this.mainTab = 'Scene'
    },
    showBoard() {
        this.mainTab = 'Board';
    },
    moveLeft() {
        for (const canvas of this._canvases()) {
            this._canvasMoveX(-this.canvasMoveStep, canvas);
        }
    },
    moveRight() {
        for (const canvas of this._canvases()) {
            this._canvasMoveX(this.canvasMoveStep, canvas);
        }
    },
    moveTop() {
        for (const canvas of this._canvases()) {
            this._canvasMoveY(-this.canvasMoveStep, canvas);
        }
    },
    moveBottom() {
        for (const canvas of this._canvases()) {
            this._canvasMoveY(this.canvasMoveStep, canvas);
        }
    },
    fabricWidth() {
        let fabric = this.fabric();
        if (!fabric || !fabric.fullWidth) {
            return this.width;
        }
        return fabric.fullWidth;
    },
    fabricHeight() {
        let fabric = this.fabric();
        if (!fabric || !fabric.fullHeight) {
            return this.height;
        }
        return fabric.fullHeight;
    },
    canvasWrapperStyle() {
        return {
            height: game.height + 'px',
            width: game.width + 'px',
            overflow: 'hidden !important'
        }
    },
    fabric() {
        let fabric = 'fabric' + this.mainTab;
        return this[fabric];
    },
    zoomIn() {
        this._scaleRatio(1 + this.canvasScaleStep);
        this._zoom();
    },
    zoomOut() {
        this._scaleRatio(1 - this.canvasScaleStep);
        this._zoom();
    },
    zoomReset() {
        this._scaleRatio();
        this._zoom();
    },
    _zoom() {
        let fabric = this.fabric();
        fabric.setDimensions({
            width: fabric.fullWidth * fabric.scaleRatio,
            height: fabric.fullHeight * fabric.scaleRatio
        });
        fabric.setZoom(fabric.scaleRatio);
    },
    _canvasMoveX(value, canvas) {
        let current = Number(canvas.style.left.slice(0, -2));
        canvas.style.left = current + value + 'px';
    },
    _canvasMoveY(value, canvas) {
        let current = Number(canvas.style.top.slice(0, -2));
        canvas.style.top = current + value + 'px';
    },
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    _scaleRatio(multiplier = null) {
        if (!multiplier) {
           this.fabric().scaleRatio = 1;
           return;
        }
        let ratio = this.fabric().scaleRatio;
        if (!ratio) {
            ratio = 1;
        }
        this.fabric().scaleRatio = ratio * multiplier;
    },
    _cardObject(id) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        if (!this.cards[id].obj) {
            throw new Error('Canvas object for card not found: ' + id);
        }

        return this.cards[id].obj;
    }
});
