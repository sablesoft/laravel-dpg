import { reactive } from 'vue';
import './fabric.card';
import {fabric} from "fabric";

export const game = reactive({
    // game id:
    id: null,
    // game info:
    info: null,
    // user role code:
    role: null,
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
    // active dome and scene on tabs:
    activeDomeId: null,
    activeSceneId: null,
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
    // board canvas config:
    canvas: null,
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
        this.role = options.role;
    },
    isMaster() {
        return this.role === 'master';
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
        options || (options = {});
        options.back_image = this.cardsBack;

        return this.cards[id].obj = new fabric.Card(this.cards[id], options);
    },
    showMap() {
        this.mainTab = 'Map';
        let dome = this.domes[this.activeDomeId];
        if (!dome) {
            throw new Error('Active scene not found!');
        }
        this.setActiveCard(dome.scope_id);
    },
    showScene() {
        this.mainTab = 'Scene';
        let scene = this.scenes[this.activeSceneId];
        if (!scene) {
            throw new Error('Active scene not found!');
        }
        this.setActiveCard(scene.scope_id);
    },
    showBoard() {
        this.mainTab = 'Board';
        this.setActiveCard();
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
    saveCanvas() {
        let canvas = this._canvases()[0];
        let style = {
            left: canvas.style.left,
            top: canvas.style.top
        }
        let data = {
            gameId : this.id,
            fields: ['canvas'],
            canvas : {
                style: style,
                scale: this.getScale()
            },
        }
        switch(this.mainTab) {
            case 'Map':
                data['process'] = 'dome';
                data['processId'] = 1; // todo
                break;
            case 'Scene':
                data['process'] = 'scene';
                data['processId'] = 1; // todo
                break;
            case 'Board':
                data['process'] = 'game';
                break;
            default:
                throw new Error('Invalid main tab');
        }
        axios.patch('/game', data)
            .then(res => {
                console.log(res.data);
            }).catch(err => {
                console.error(err);
            });
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
    scaleIn() {
        this.scale(1 + this.canvasScaleStep);
    },
    scaleOut() {
        this.scale(1 - this.canvasScaleStep);
    },
    scaleReset() {
        this.scale();
    },
    getScale() {
        return this.fabric().scaleRatio ?
            this.fabric().scaleRatio : 1;
    },
    scale(multiplier = null) {
        this.fabric().scaleRatio = multiplier ?
            this.getScale() * multiplier : 1;
        this._zoom();
    },
    setCanvasConfig(config) {
        if (!config) {
            return;
        }
        setTimeout(function() {
            game.setCanvasStyle(config.style);
            game.setScale(config.scale);
        }, 100);
    },
    setScale(scale = null) {
        scale = scale || 1;
        this.fabric().scaleRatio = scale;
        this._zoom();
    },
    setCanvasStyle(style) {
        if (!style instanceof Object) {
            return;
        }
        for (const [key, value] of Object.entries(style)) {
            for (const canvas of this._canvases()) {
                canvas.style[key] = value;
            }
        }
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
