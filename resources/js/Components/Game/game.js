import {shallowReactive, toRaw} from 'vue';
import {fabric} from "fabric-with-erasing";
import './fabric.card';
import './fabric.area';
import './fabric.marker';
import './fabric.book';

/**
 * @typedef {Object} CanvasConfig
 * @property {number} scale
 * @property {Object} style
 */

/**
 * @typedef {Object} GameOptions
 * @property {number} width
 * @property {number} height
 * @property {string} role
 */

/**
 * @typedef {Object} ActiveInfo
 * @property {?number} id
 * @property {?string} type
 * @property {?string} name
 * @property {?string} scopeName
 * @property {?string} desc
 * @property {?string} image
 * @property {?string} scopeImage
 */

/**
 * @typedef {Object} ActiveCard
 * @property {?number} id
 * @property {?string} name
 * @property {?string} scopeName
 * @property {?string} desc
 * @property {?string} image
 * @property {?string} scopeImage
 */

/**
 * @typedef {Object} ActiveBook
 * @property {?number} id
 * @property {?string} name
 * @property {?string} desc
 * @property {?string} image
 */

/**
 * @typedef {Object} GameCard
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?string} info
 * @property {?string} code
 * @property {string} currentName
 * @property {?string} currentDesc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {?string} scopeImage
 * @property {?string} scopeName
 * @property {?fabric.Card} card
 * @property {?fabric.Marker} marker
 */

/**
 * @typedef {Object} Deck
 * @property {number} id
 * @property {number} scope_id
 * @property {number} target_id
 * @property {?string} desc
 * @property {number} type
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {Object.<number, number>} cards
 */

/**
 * @typedef {Object} Book
 * @property {number} id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number[]} dome_ids
 * @property {number[]} scene_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 * @property {?fabric.Book} book
 */

/**
 * @typedef {Object} Dome
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?string} image
 * @property {?CanvasConfig} canvas
 * @property {number} area_height
 * @property {number} area_width
 * @property {?number[]} area_mask
 * @property {number} top_step
 * @property {number} left_step
 * @property {number|string} map_width
 * @property {number|string} map_height
 * @property {number[]} land_ids
 * @property {number[]} area_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} Land
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number[]} area_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} GameArea
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number} top
 * @property {number} top_step
 * @property {number} left
 * @property {number} left_step
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 * @property {?fabric.Area} area
 */

/**
 * @typedef {Object} Scene
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

export const game = shallowReactive({
    /**
     * @member {?number} - game id
     */
    id: null,
    /**
     * @member {?ActiveInfo} - game info
     */
    info: {
        id: null,
        type: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null
    },
    /**
     * @member {?string} - user role code
     */
    role: null,
    cursorName: null,
    cursorScope: null,
    activeCardTapped: false,
    activeObjectType: null,
    activeObjectHidden: false,
    selectedId: null,
    /**
     * @member {?fabric.Object}
     */
    activeObject: null,
    /**
     * @member {?ActiveInfo} - mainTab info
     */
    activeInfo: {
        id: null,
        type: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null
    },
    /**
     * State of Card component
     * @member {ActiveCard}
     */
    activeCard: {
        id: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null,
    },
    /**
     * State of Book component
     * @member {ActiveBook}
     */
    activeBook: {
        id: null,
        name: null,
        desc: null,
        image: null,
    },
    /**
     * @member {?string} - board image
     */
    boardImage: null,
    /**
     * @member {?string} - cards back image
     */
    cardsBack: null,
    /**
     * @member {?number} - main quest id
     */
    questId: null,
    /**
     * @member {?number[]} - game hero ids
     */
    heroIds: null,
    /**
     * @member {?number[]} - game custom card ids
     */
    cardIds: null,
    /**
     * @member {?number[]} - game custom deck ids
     */
    deckIds: null,
    /**
     * @member {?number} - active dome id
     */
    activeDomeId: null,
    /**
     * @member {?number} - active area id
     */
    activeAreaId: null,
    /**
     * @member {?number} - active scene id
     */
    activeSceneId: null,
    /**
     * @member {?number[]} - open dome ids
     */
    openDomeIds: null,
    /**
     * @member {?number[]} - open land ids
     */
    openLandIds: null,
    /**
     * @member {?number[]} - open area ids
     */
    openAreaIds: null,
    /**
     * @member {?number[]} - open scene ids
     */
    openSceneIds: null,
    /**
     * @member {?number[]} - open deck ids
     */
    openDeckIds: null,
    /**
     * @member {?number[]} - open card ids
     */
    openCardIds: null,
    /**
     * @member {Object.<number, Book>}
     */
    books: null,
    /**
     * @member {Object.<number, GameCard>}
     */
    cards: null,
    /**
     * @member {Object.<number, Deck>}
     */
    decks: null,
    /**
     * @member {Object.<number, Dome>}
     */
    domes: null,
    /**
     * @member {Object.<number, Land>}
     */
    lands: null,
    /**
     * @member {Object.<number, GameArea>}
     */
    areas: null,
    /**
     * @member {Object.<number, Scene>}
     */
    scenes: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbBoard: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbMap: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbScene: null,
    /**
     * @member {string}
     */
    mainTab: 'Board',
    /**
     * @member {string}
     */
    asideTab: 'Info',
    /**
     * Screen width
     * @member {?number}
     */
    width: null,
    /**
     * Screen height
     * @member {?number}
     */
    height: null,
    /**
     * @member {?CanvasConfig}
     */
    canvas: null,
    // canvas control modes:
    modeErase: false,
    modeEraseUndo: false,
    modeTransform: false,
    modeSave: false,
    modeMarkers: false,
    hideOpacity: 0.5,
    fogColor: '#ffffff',
    brushWidth: 50,
    /**
     * @param {Object.<string, any>} data
     * @param {GameOptions} options
     */
    init(data, options) {
        for (const [key, value] of Object.entries(data)) {
            this[key] = toRaw(value);
        }
        this.info.id = null;
        this.info.type = 'game';
        this.width = options.width;
        this.height = options.height;
        this.role = options.role;
        this.showInfo();
    },
    /**
     * @param {?Object.<string, any>} options
     * @param {?Object.<string, any>} config
     * @return {fabric.Canvas}
     */
    initFabric(options = null, config = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fb = new fabric.Canvas(canvas);
        if (config) {
            fb.loadFromJSON(config, fb.renderAll.bind(fb));
        }
        options = options || {};
        options['preserveObjectStacking'] = true;
        for (const [key, value] of Object.entries(options)) {
            fb[key] = value;
        }
        let self = this;
        setTimeout(function() {
            fb.getObjects().forEach(function(o) {
                if (o.type === 'area') {
                    o.sendBackwards(true);
                }
                if (o.type === 'marker' && self.isMaster()) {
                    o.unlockMovement();
                }
            });
        }, 500);
        let name = 'fb' + this.mainTab;
        this[name] = fb;
        fb.on('selection:created', opt => {
            // console.debug('selection:created', opt);
            self._selection(opt);
        });
        fb.on('selection:updated', opt => {
            // console.debug('selection:updated', opt);
            self._selection(opt);
        });
        fb.on('selection:cleared', () => {
            // console.debug('selection:cleared', opt);
            self._selection();
        });
        fb.on('mouse:down', opt => {
            // console.debug('mouse:down', opt);
            let evt = opt.e;
            if (self.modeTransform === true) {
                this.isDragging = true;
                this.selection = false;
                this.lastPosX = evt.clientX;
                this.lastPosY = evt.clientY;
            }
            // clear aside if no target:
            if (!opt.target) {
                self.showInfo();
            }
        });
        fb.on('mouse:move', opt => {
            // console.debug('mouse:move', opt);
            if (this.isDragging) {
                let e = opt.e;
                let vpt = this.viewportTransform;
                vpt[4] += e.clientX - this.lastPosX;
                vpt[5] += e.clientY - this.lastPosY;
                this.requestRenderAll();
                this.lastPosX = e.clientX;
                this.lastPosY = e.clientY;
            }
            self._cursor(opt.target);
        });
        fb.on('mouse:out', () => {
            // console.debug('mouse:out', opt);
            self._cursor();
        });
        fb.on('mouse:up', () => {
            // console.debug('mouse:up', opt);
            this.setViewportTransform(this.viewportTransform);
            this.isDragging = false;
            this.selection = true;
        });
        fb.on('mouse:wheel', opt => {
            // console.debug('mouse:wheel', opt);
            if (self.modeTransform) {
                let delta = opt.e.deltaY;
                if (self.activeObjectType === 'marker') {
                    let o = self._findObject(self.activeCard.id, 'cards', 'marker');
                    let scale = o.get('scaleX');
                    scale *= 0.999 ** delta;
                    if (scale > 20) scale = 20;
                    if (scale < 0.01) scale = 0.01;
                    o.scale(scale);
                    fb.requestRenderAll();
                    console.debug('scale marker', o);
                } else {
                    let zoom = fb.getZoom();
                    zoom *= 0.999 ** delta;
                    if (zoom > 20) zoom = 20;
                    if (zoom < 0.01) zoom = 0.01;
                    fb.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
                }
                opt.e.preventDefault();
                opt.e.stopPropagation();
            }
        });

        return fb;
    },
    isMaster() {
        return this.role === 'master';
    },
    setActiveObject(o = null) {
        if (!o) {
            this.activeObject = null;
            this.activeObjectHidden = null;
            this.activeObjectType = null;
            this.fb().discardActiveObject();
        } else {
            this.activeObject = o;
            this.activeObjectHidden = o.get('opacity') < 1;
            this.activeObjectType = o.type;
            this.fb().setActiveObject(o);
        }
        console.debug('Active Object', o, {
            hidden: this.activeObjectHidden,
            type: this.activeObjectType
        });
    },
    showInfo() {
        this.asideTab = 'Info';
        if (this.fb()) {
            this.fb().discardActiveObject();
        }
        switch (this.mainTab) {
            case 'Board':
                this.activeInfo = this.info;
                return;
            case 'Map':
                let dome = this.activeDome();
                let domeCard = this.cards[dome.scope_id];
                this.activeInfo = {
                    id: dome.id,
                    type: 'dome',
                    name: dome.name,
                    desc: dome.desc,
                    image: domeCard.image,
                    scopeImage: domeCard.scopeImage,
                    scopeName: domeCard.scopeName
                };
                return;
            case 'Scene':
                let scene = this.activeScene();
                let sceneCard = this.cards[scene.scope_id];
                this.activeInfo = {
                    id: scene.id,
                    type: 'scene',
                    name: scene.name,
                    desc: scene.desc,
                    image: sceneCard.image,
                    scopeImage: sceneCard.scopeImage,
                    scopeName: sceneCard.scopeName
                };
                return;
            default:
                throw new Error('Invalid main tab: ' + this.mainTab);
        }
    },
    /**
     * @param {string} tab
     */
    showMain(tab) {
        if (this.mainTab === tab) {
            return;
        }
        this._offModes();
        this.saveCanvas();
        this.mainTab = tab;
        this.showInfo();
    },
    /**
     * @param {?fabric.Object|number} o
     * @param {?string} type
     * @return {void}
     */
    showAside(o = null, type = null) {
        if (!o) {
            return this.showInfo();
        }
        let id = null;
        if (typeof o === 'object') {
            type = o.type;
            let field = type + '_id';
            id = o[field];
        } else {
            id = o;
        }
        if (!id || !type) {
            return this.showInfo();
        }
        switch (type) {
            case 'book':
                return this.showBook(id);
            case 'card':
            case 'marker':
                return this.showCard(id);
            default:
                throw new Error('Unknown object type: ' + type);
        }
    },
    showBook(id) {
        let book = this.books[id];
        console.debug('Show Book', book);
        if (!book) {
            throw new Error('Book not found: ' + id);
        }
        this.activeBook = {
            id: book.id,
            name: book.name,
            desc: book.desc,
            image: book.image
        };
        this.asideTab = 'Book';
    },
    showCard(id) {
        let card = this.cards[id];
        console.debug('Show Card', card);
        if (!card) {
            throw new Error('Card not found: ' + id);
        }
        this.activeCard = {
            id: card.id,
            name: card.name,
            desc: card.desc,
            image: card.image,
            scopeImage: card.scopeImage,
            scopeName: card.scopeName,
        };
        this.asideTab = 'Card';
    },
    activeCardTap() {
        this.activeCard.tapped = this._findObject(this.activeCard.id, 'cards', 'card').tap();
        this.activeCardTapped = this.activeCard.tapped;
    },
    activeCardUntap() {
        this.activeCard.tapped = !this._findObject(this.activeCard.id, 'cards', 'card').untap();
        this.activeCardTapped = this.activeCard.tapped;
    },
    /**
     * @param {boolean} show
     */
    opacity(show = true) {
        if (!this.activeObject) {
            throw new Error('Active object not found for opacity!');
        }
        this.activeObjectHidden = !show;
        let opacity = show ? 1 : (this.isMaster() ? this.hideOpacity : 0);
        this.activeObject.set('opacity', opacity);
        this.fb().renderAll();
    },
    /**
     * @param {string} type
     */
    forward(type) {
        this._forward(this.activeCard.id, 'cards', type);
    },
    /**
     * @param {string} type
     */
    backward(type) {
        this._backward(this.activeCard.id, 'cards', type);
    },
    remove(type) {
        let o = this._findObject(this.activeCard.id, 'cards', type);
        console.debug('Remove object for', this.activeCard.name,  o);
        this.fb().remove(o, this.fb().renderAll.bind(this.fb()));
        this.showInfo();
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Card}
     */
    createCardFabric(id, options, add = true) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        options || (options = {});
        options.back_image = toRaw(this.cardsBack);
        let o = new fabric.Card(toRaw(this.cards[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }

        return this.cards[id].card = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Area}
     */
    createAreaFabric(id, options = null, add = true) {
        /**
         * @type {GameArea}
         */
        let area = toRaw(this.areas[id]);
        if (!area) {
            throw new Error('Area not found: ' + id);
        }
        options || (options = {});
        let dome = toRaw(this.domes[area.dome_id]);
        if (!dome) {
            throw new Error('Dome for area not found: ' + id);
        }
        options.width = dome.area_width;
        options.height = dome.area_height;
        options.mask = Array.from(dome.area_mask);
        let o = new fabric.Area(area, options);
        if (add) {
            this.fb().add(o);
            o.sendBackwards(true);
            this.fb().requestRenderAll();
        }

        return this.areas[id].area = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Marker}
     */
    createMarkerFabric(id, options = null, add = true) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        let o = new fabric.Marker(toRaw(this.cards[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }

        return this.cards[id].marker = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createBookFabric(id, options = null, add = true) {
        if (!this.books[id]) {
            throw new Error('Card not found: ' + id);
        }
        options = options || {};
        options.back_image = options.back_image || this.cardsBack;
        options.scopeName = 'Book'; // todo - add dictionary from backend
        let o = new fabric.Book(toRaw(this.books[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        console.debug('Book object', o);

        return this.books[id].book = o;
    },
    createFog(width, height) {
        let self = this;
        setTimeout(function() {
            console.debug('Add fog');
            let fog = new fabric.Rect({
                originX: 'left',
                originY: 'top',
                fill: 'white',
                width: width,
                height: height,
                stroke: null,
                evented: false,
                opacity: self.isMaster() ? 0.5 : 1,
            });
            self.fb().add(fog);
            self.freezeFog();
        }, 1000);
    },
    /**
     * @returns {Dome}
     */
    activeDome() {
        let dome = this.domes[this.activeDomeId];
        if (!dome) {
            throw new Error('Active dome not found!')
        }

        return dome;
    },
    /**
     * @returns {GameArea}
     */
    activeArea() {
        let area = this.areas[this.activeAreaId];
        if (!area) {
            throw new Error('Active area not found!');
        }

        return area;
    },
    /**
     * @return {Scene}
     */
    activeScene() {
        let scene = this.scenes[this.activeSceneId];
        if (!scene) {
            throw new Error('Active scene not found!');
        }

        return scene;
    },
    switchTransform() {
        this._offModes('Transform');
        this.modeTransform = !this.modeTransform;
    },
    switchErase() {
        this._offModes('Erase');
        this.modeErase = !this.modeErase;
        let canvas = this.fb();
        if (this.modeErase) {
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            this.setBrushWidth();
            canvas.isDrawingMode = true;
        } else {
            canvas.isDrawingMode = false;
        }
    },
    switchEraseUndo() {
        this._offModes('EraseUndo');
        this.modeEraseUndo = !this.modeEraseUndo;
        let canvas = this.fb();
        if (this.modeEraseUndo) {
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            this.setBrushWidth();
            canvas.freeDrawingBrush.inverted = true;
            canvas.isDrawingMode = true;
            this.opacityFog();
        } else {
            canvas.isDrawingMode = false;
            this.opacityFog(false);
        }
    },
    switchMarkers() {
        this._offModes('Markers');
        this.modeMarkers = !this.modeMarkers;
        this.selectedId = null;
        this.showInfo();
    },
    addMarker() {
        console.debug('Add marker for: ', this.activeCard.name);
        let center = this._center();
        let o = this.createMarkerFabric(this.selectedId, {
            left: center.x,
            top: center.y
        });
        this.fb().renderAll();
        if (this.isMaster()) {
            o.unlockMovement();
        }
    },
    saveCanvas() {
        this.modeSave = true;
        let data = {
            gameId : this.id,
            fields: ['canvas'],
            canvas : this.fb().toObject(['viewportTransform'])
        }
        switch(this.mainTab) {
            case 'Map':
                data['process'] = 'dome';
                data['processId'] = this.activeDomeId;
                this.domes[this.activeDomeId].canvas = data['canvas'];
                break;
            case 'Scene':
                data['process'] = 'scene';
                data['processId'] = this.activeSceneId;
                this.scenes[this.activeSceneId].canvas = data['canvas'];
                break;
            case 'Board':
                data['process'] = 'game';
                this.canvas = data['canvas'];
                break;
            default:
                throw new Error('Invalid main tab');
        }
        if (this.isMaster()) {
            let self = this;
            axios.patch('/game', data)
                .then(() => {
                    self.modeSave = false;
                }).catch(err => {
                    self.modeSave = false;
                    console.error(err);
                });
        } else {
            this.modeSave = false;
        }
    },
    /**
     * @returns {{overflow: string, width: string, height: string}}
     */
    canvasWrapperStyle() {
        return {
            height: game.height + 'px',
            width: game.width + 'px',
            overflow: 'hidden !important'
        }
    },
    /**
     * @returns {?fabric.Canvas}
     */
    fb() {
        let fabricName = 'fb' + this.mainTab;
        return this[fabricName] || null;
    },
    renderAll() {
        if (!this.fb()) {
            throw new Error('Fabric canvas is not initiated!')
        }
        return this.fb().renderAll();
    },
    requestRenderAll() {
        if (!this.fb()) {
            throw new Error('Fabric canvas is not initiated!')
        }
        return this.fb().requestRenderAll();
    },
    resetCanvas() {
        // todo
        console.log('RESET IS TODO');
    },
    freezeFog() {
        this.fb().getObjects().forEach(function(o) {
            if (o.type === 'rect') {
                o.set('hasControls', false);
                o.set('hasBorders', false);
                o.set('lockMovementX', true);
                o.set('lockMovementY', true);
                o.set('lockScalingX', true);
                o.set('lockScalingY', true);
                o.set('lockRotation', true);
                o.set('selectable', false);
                o.set('evented', false);
                o.set('hoverCursor', 'default');
                o.bringForward();
                console.debug('Fog freeze!');
            }
        });
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookDomes(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openDomeIds if no master

        book.dome_ids.forEach(function(id) {
            filtered[id] = toRaw(self.domes[id]);
        });

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookScenes(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openSceneIds if no master

        book.scene_ids.forEach(function(id) {
            filtered[id] = toRaw(self.scenes[id]);
        });

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookDecks(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openDeckIds if no master

        book.deck_ids.forEach(function(id) {
            let deck = toRaw(self.decks[id]);
            let scope = self.cards[deck.scope_id];
            let target = self.cards[deck.target_id];
            filtered[id] = {
                id: id,
                scope: scope.name,
                target: target.name
            }
        });
        console.log('Decks', filtered);

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookCards(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openCardIds if no master

        book.card_ids.forEach(function(id) {
            filtered[id] = toRaw(self.cards[id]);
        });

        return filtered;
    },
    opacityFog(show = true) {
        let fog = this._fog();
        if (!fog) {
            return;
        }
        let o = this.activeObject;
        this.activeObject = fog;
        this.opacity(show);
        this.activeObject = o;
    },
    /**
     * @param {?number} width
     */
    setBrushWidth(width = null) {
        this.brushWidth = width ? width : this.brushWidth;
        if (!this.fb().freeDrawingBrush) {
            throw new Error('Drawing brush did not initiated!');
        }
        this.fb().freeDrawingBrush.width = this.brushWidth;
        this.requestRenderAll();
    },
    selectDome(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let dome = this.domes[event.target.value];
        console.debug('Selected Dome', dome);
        // todo
    },
    selectScene(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let scene = this.scenes[event.target.value];
        console.debug('Selected Scene', scene);
        // todo
    },
    selectDeck(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let deck = this.decks[event.target.value];
        console.debug('Selected Deck', deck);
        // todo
    },
    selectCard(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showCard(event.target.value);
    },
    /**
     * @return {HTMLCollectionOf<HTMLCanvasElement>}
     * @private
     */
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    /**
     *
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @return {*}
     * @private
     */
    _findObject(id, entity, type) {
        if (!this[entity][id]) {
            throw new Error('Entity not found: ' + entity + ' : ' + id);
        }
        let model = this[entity][id];
        if (!model[type]) {
            let found = null;
            this.fb().forEachObject(function(o) {
                if (found) {
                    return;
                }
                if (o.type === type && Number(o.get('card_id')) === Number(id)) {
                    found = o;
                }
            });
            if (!found) {
                throw new Error('Fabric object in '+ entity +' not found: ' + type + ' : ' + id);
            }
            model[type] = found;
            this[entity][id] = model;
        }
        return model[type];
    },
    /**
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @private
     */
    _forward(id, entity, type) {
        console.debug('Forward for', entity, type, id);
        this._findObject(id, entity, type).bringForward(true);
        this.fb().renderAll();
    },
    /**
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @private
     */
    _backward(id, entity, type) {
        console.debug('Backward for', entity, type, id);
        this._findObject(id, entity, type).sendBackwards(true);
        this.fb().renderAll();
    },
    _selection(event = null) {
        if (this.modeMarkers) {
            this.setActiveObject();
            return;
        }
        if (!event) {
            this.setActiveObject();
            this.showAside();
            return;
        }
        let o = event.selected[0];
        this.setActiveObject(o);
        this.showAside(o);
    },
    _center() {
        let port = this.fb().calcViewportBoundaries();
        return {
            x: parseInt(port.tl.x + (port.br.x - port.tl.x)/2),
            y: parseInt(port.tl.y + (port.br.y - port.tl.y)/2)
        }
    },
    /**
     * @param {?fabric.Object} o
     * @private
     */
    _cursor(o = null) {
        if (!o) {
            this.cursorName = null;
            this.cursorScope = null;
            return;
        }
        if (o.get('card_id')) {
            let card = this.cards[o.get('card_id')];
            this.cursorName = card.name;
            this.cursorScope = card.scopeName;
        }
        if (o.get('marker_id')) {
            let card = this.cards[o.get('marker_id')];
            this.cursorName = card.name;
            this.cursorScope = card.scopeName;
        }
        if (o.get('book_id')) {
            let book = this.books[o.get('book_id')];
            this.cursorName = book.name;
            this.cursorScope = 'Book';
        }
    },
    _fog() {
        return this.fb().getObjects('rect')[0]; // todo - create fog object
    },
    /**
     * @param {?string} skip
     * @private
     */
    _offModes(skip = null) {
        let modes = ['Erase', 'EraseUndo', 'Markers', 'Transform'];
        modes = modes.filter(function(mode) {
            return mode !== skip;
        });
        let self = this;
        modes.forEach(function(mode) {
           let modeFlag = 'mode' + mode;
           let modeSwitcher = 'switch' + mode;
           if (self[modeFlag]) {
               self[modeSwitcher]();
           }
        });
        this._cursor();
    }
});
