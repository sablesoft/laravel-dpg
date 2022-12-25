import {shallowReactive, toRaw} from 'vue';
import {fabric} from "fabric-with-erasing";
import './fabric.card';
import './fabric.area';
import './fabric.marker';
import './fabric.book';
import './fabric.dome';
import './fabric.fog';

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
 * @property {?number} scopeId
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
 * @typedef {Object} ActiveArea
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
        scopeId: null,
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
        scopeId: null,
        type: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null
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
     * @member {number[]} - open book ids
     */
    visibleBookIds: [],
    /**
     * @member {number[]} - open dome ids
     */
    visibleDomeIds: [],
    /**
     * @member {number[]} - open land ids
     */
    visibleLandIds: [],
    /**
     * @member {number[]} - open area ids
     */
    visibleAreaIds: [],
    /**
     * @member {number[]} - open scene ids
     */
    visibleSceneIds: [],
    /**
     * @member {number[]} - open deck ids
     */
    visibleDeckIds: [],
    /**
     * @member {number[]} - open card ids
     */
    visibleCardIds: [],
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
    canMap: false,
    canScene: false,
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
    hideOpacity: 0.5,
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
        this.canScene = this.isMaster() ? !!game.activeSceneId :
            game.activeSceneId && this.visibleSceneIds.includes(Number(game.activeSceneId));
        this.canMap = this.isMaster() ? !!game.activeDomeId :
            game.activeDomeId && this.visibleDomeIds.includes(Number(game.activeDomeId));

        console.debug('Game initiated', this);
    },
    /**
     * @param {?Object.<string, any>} options
     * @param {?Object.<string, any>} json
     * @return {fabric.Canvas}
     */
    initCanvas(json = null, options = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fb = new fabric.Canvas(canvas);
        if (json) {
            fb.loadFromJSON(json, fb.renderAll.bind(fb));
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
            });
        }, 500);
        let name = 'fb' + this.mainTab;
        this[name] = fb;
        fb.on('selection:created', function(opt) {
            // console.debug('selection:created', opt);
            self._selection(opt);
        });
        fb.on('selection:updated', function(opt) {
            // console.debug('selection:updated', opt);
            self._selection(opt);
        });
        fb.on('selection:cleared', function() {
            // console.debug('selection:cleared', opt);
            self._selection();
        });
        fb.on('mouse:wheel', function(opt) {
            // console.debug('mouse:wheel', opt);
            if (self.modeTransform) {
                let delta = opt.e.deltaY;
                if (self.activeObjectType === 'marker') {
                    let o = self.activeObject;
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
        fb.on('mouse:down', function(opt) {
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
        fb.on('mouse:move', function(opt) {
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
        fb.on('mouse:out', function() {
            // console.debug('mouse:out', opt);
            self._cursor();
        });
        fb.on('mouse:up', function() {
            // console.debug('mouse:up', this);
            this.setViewportTransform(this.viewportTransform);
            this.isDragging = false;
            this.selection = true;
        });

        return fb;
    },
    isMaster() {
        return this.role === 'master';
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
                let dome = this.getActiveDome();
                let domeCard = this.cards[dome.scope_id];
                this.activeInfo = {
                    id: dome.id,
                    scopeId: dome.scope_id,
                    type: 'dome',
                    name: dome.name,
                    desc: dome.desc,
                    image: domeCard.image,
                    scopeImage: domeCard.scopeImage,
                    scopeName: domeCard.scopeName
                };
                return;
            case 'Scene':
                let scene = this.getActiveScene();
                let sceneCard = this.cards[scene.scope_id];
                this.activeInfo = {
                    id: scene.id,
                    scopeId: scene.scope_id,
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
        this.save();
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
        // noinspection FallThroughInSwitchStatementJS
        switch (type) {
            case 'book':
                return this.showBook(id);
            case 'card':
                if (o) {
                    if (!o.get('opened') && !this.isMaster()) {
                        return this.showInfo();
                    }
                    this.activeCardTapped = Boolean(o.get('tapped'));
                }
            case 'marker':
                return this.showCard(id);
            case 'area':
                return this.showArea(id);
            case 'dome':
                return this.showDome(id);
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
        this.activeInfo = {
            id: book.id,
            type: 'book',
            name: book.name,
            desc: book.desc,
            image: book.image,
            scopeImage: null,
            scopeName: null
        };
        let self = this;
        this.fb().getObjects('book').forEach(function(o) {
            if (o.get('book_id') === Number(id)) {
                self.setActiveObject(o);
            }
        });
        this.asideTab = 'Book';
    },
    showDome(id) {
        let dome = this.domes[id];
        console.debug('Show Dome', dome);
        if (!dome) {
            throw new Error('Dome not found: ' + id);
        }
        let domeCard = this.cards[dome.scope_id];
        if (!domeCard) {
            throw new Error('Dome card not found: ' + dome.scope_id);
        }
        this.activeInfo = {
            id: dome.id,
            scopeId: dome.scope_id,
            type: 'dome',
            name: domeCard.name,
            desc: domeCard.desc,
            image: domeCard.image,
            scopeImage: null,
            scopeName: null
        };
        let self = this;
        this.fb().getObjects('dome').forEach(function(o) {
            if (o.get('dome_id') === Number(id)) {
                self.setActiveObject(o);
            }
        });
        this.asideTab = 'Dome';
    },
    showCard(id) {
        let card = this.cards[id];
        console.debug('Show Card', card);
        if (!card) {
            throw new Error('Card not found: ' + id);
        }
        this.activeInfo = {
            id: card.id,
            scopeId: card.scope_id,
            type: 'card',
            name: card.name,
            desc: card.desc,
            image: card.image,
            scopeImage: card.scopeImage,
            scopeName: card.scopeName,
        };
        this.asideTab = 'Card';

        return this;
    },
    showArea(id) {
        let area = this.areas[id];
        console.debug('Show Area', area);
        if (!area) {
            throw new Error('Area not found: ' + id);
        }
        let areaCard = this.cards[area.scope_id];
        if (!areaCard) {
            throw new Error('Area card not found: ' + area.scope_id);
        }
        this.activeInfo = {
            id: area.id,
            scopeId: area.scope_id,
            type: 'area',
            name: areaCard.name,
            desc: areaCard.desc,
            image: areaCard.image,
            scopeImage: areaCard.scopeImage,
            scopeName: areaCard.scopeName,
        };
        this.asideTab = 'Area';
    },
    activeCardTap() {
        this.activeCardTapped = this.activeObject.tap();
    },
    activeCardUntap() {
        this.activeCardTapped = !this.activeObject.untap();
    },
    /**
     * @param {boolean} show
     */
    visibility(show = true) {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object not found for opacity!');
        }
        this.activeObjectHidden = !show;
        if (typeof o.visibility === 'function') {
            o.visibility(show);
        } else {
            let opacity = show ? 1 : (this.isMaster() ? this.hideOpacity : 0);
            o.set('opacity', opacity);
            this.activeObjectHidden = opacity < 1;
            this.fb().renderAll();
        }
        switch (o.type) {
            case 'card':
                this._visibility('card', o.get('card_id'), show);
                break;
            case 'marker':
                this._visibility('card', o.get('marker_id'), show);
                break;
            case 'dome':
                this._visibility('dome', o.get('dome_id'), show);
                break;
            case 'area':
                this._visibility('area', o.get('area_id'), show);
                break;
            case 'book':
                this._visibility('book', o.get('book_id'), show);
                break;
            default:
                console.warn('Unknown object for visibility: ', o);
        }
    },
    forward() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for forward not found!');
        }
        console.debug('Forward object', o);
        o.bringForward(true);
        this.fb().renderAll();
    },
    backward() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for backward not found!');
        }
        console.debug('Backward object', o);
        o.sendBackwards(true);
        this.fb().renderAll();
    },
    remove() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for removing not found!');
        }
        console.debug('Remove object', o);
        this.fb().remove(o, this.fb().renderAll.bind(this.fb()));
        this.setActiveObject();
        this.showInfo();
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Card}
     */
    createCardFabric(id, options, add = true) {
        let o = new fabric.Card(id, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created card object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Area}
     */
    createAreaFabric(id, options = null, add = true) {
        let o = new fabric.Area(id, options);
        if (add) {
            this.fb().add(o);
            o.sendBackwards(true);
            this.fb().requestRenderAll();
        }
        // console.debug('Created area object', o);

        return o;
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
        // console.debug('Created marker object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createBookFabric(id, options = null, add = true) {
        if (!this.books[id]) {
            throw new Error('Book not found: ' + id);
        }
        options = options || {};
        options.back_image = options.back_image || this.cardsBack;
        options.scopeName = 'Book'; // todo - add dictionary from backend
        let o = new fabric.Book(toRaw(this.books[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created book object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createDomeFabric(id, options = null, add = true) {
        let dome = this.domes[id];
        if (!dome) {
            throw new Error('Dome not found: ' + id);
        }
        options = options || {};
        let domeCard = this.cards[dome.scope_id];
        options.image = domeCard.image;
        options.back_image = options.back_image || this.cardsBack;
        options.scopeName = 'Dome'; // todo - add dictionary from backend
        let o = new fabric.Dome(toRaw(dome), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        console.debug('Created dome object', o);

        return o;
    },
    createFog(width, height) {
        let self = this;
        setTimeout(function() {
            console.debug('Add fog');
            self.fb().add(new fabric.Fog({
                width: width,
                height: height
            }));
        }, 500);
    },
    addDome() {
        let center = this._center();
        this.createDomeFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.showDome(this.activeInfo.id);
    },
    addBook() {
        let center = this._center();
        this.createBookFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.showBook(this.activeInfo.id);
    },
    addCard() {
        let center = this._center();
        let o = this.createCardFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.setActiveObject(o);
        this.showCard(this.activeInfo.id);
    },
    addMarker() {
        let center = this._center();
        let o = this.createMarkerFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.setActiveObject(o);
        this.showCard(this.activeInfo.id);
    },
    getCardName(id, current = true) {
        let card = this.cards[id];
        if (!card) {
            console.error('Card for name not found', id);
            return null;
        }
        return current ? card.currentName : card.name;

    },
    /**
     * @returns {Dome}
     */
    getActiveDome() {
        let dome = this.domes[this.activeDomeId];
        if (!dome) {
            throw new Error('Active dome not found!')
        }

        return dome;
    },
    /**
     * @returns {GameArea}
     */
    getActiveArea() {
        let area = this.areas[this.activeAreaId];
        if (!area) {
            throw new Error('Active area not found!');
        }

        return area;
    },
    /**
     * @return {Scene}
     */
    getActiveScene() {
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
            this.previewFog();
        } else {
            canvas.isDrawingMode = false;
            this.previewFog(false);
        }
    },
    save() {
        this.modeSave = true;
        let request = {};
        let canvas = this.fb().toObject(['viewportTransform']);
        switch(this.mainTab) {
            case 'Map':
                this.domes[this.activeDomeId].canvas = canvas;
                request['dome'] = {
                    id : this.activeDomeId,
                }
                break;
            case 'Scene':
                this.scenes[this.activeSceneId].canvas = canvas;
                request['scene'] = {
                    id : this.activeSceneId,
                }
                break;
            case 'Board':
                this.canvas = canvas;
                request['game'] = {
                    id : this.id,
                }
                break;
            default:
                throw new Error('Invalid main tab');
        }
        if (this.isMaster()) {
            Object.keys(request).forEach(function(process) {
                request[process]['data'] = {
                    canvas : canvas
                }
            });
            let self = this;
            let data = this._data();
            if (request['game']) {
                request['game']['data'] = data;
                request['game']['data']['canvas'] = canvas;
            } else {
                request['game'] = {
                    id : this.id,
                    data: data
                }
            }
            console.debug('Save request', request);
            axios.patch('/game', request)
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
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredSources(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.books) : Array.from(this.visibleBookIds);
        if (filter) {
            ids = this._filter(ids, filter, 'source_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            filtered[id] = toRaw(self.books[id]);
        });

        return filtered;
    },
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredDomes(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.domes) : Array.from(this.visibleDomeIds);
        if (filter) {
            ids = this._filter(ids, filter, 'dome_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            filtered[id] = toRaw(self.domes[id]);
        });

        return filtered;
    },
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredAreas(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.areas) : Array.from(this.visibleAreaIds);
        if (filter) {
            ids = this._filter(ids, filter, 'area_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            filtered[id] = toRaw(self.areas[id]);
        });

        return filtered;
    },
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredScenes(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.scenes) : Array.from(this.visibleSceneIds);
        if (filter) {
            ids = this._filter(ids, filter, 'scene_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            filtered[id] = toRaw(self.scenes[id]);
        });

        return filtered;
    },
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredDecks(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.decks) : Array.from(this.visibleDeckIds);
        if (filter) {
            ids = this._filter(ids, filter, 'deck_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let deck = toRaw(self.decks[id]);
            let scope = self.cards[deck.scope_id];
            let target = self.cards[deck.target_id];
            filtered[id] = {
                id: deck.id,
                type: self._deckType(deck.type),
                scope: scope.name,
                target: target.name
            }
        });

        return filtered;
    },
    /**
     * @param {?Object|string} filter
     * @return {Object<number, any>}
     */
    filteredCards(filter = null) {
        let ids = this.isMaster() ?
            Object.keys(this.cards) : Array.from(this.visibleCardIds);
        if (filter) {
            ids = this._filter(ids, filter, 'card_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            filtered[id] = toRaw(self.cards[id]);
        });

        return filtered;
    },
    /**
     * @param {boolean} enable
     */
    previewFog(enable = true) {
        let fog = this._fog();
        if (!fog) {
            return;
        }
        fog.preview(enable);
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

        return this;
    },
    selectBook(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showBook(event.target.value);
    },
    selectDome(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showDome(event.target.value);
    },
    selectArea(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showArea(event.target.value);
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
    switchCard(id) {
        this.setActiveObject();
        this.showCard(id);
    },
    /**
     * @return {HTMLCollectionOf<HTMLCanvasElement>}
     * @private
     */
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    _selection(event = null) {
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
        switch (o.type) {
            case 'card':
                if (!o.get('opened') && !this.isMaster()) {
                    this.cursorName = '???';
                    this.cursorScope = '???';
                    return;
                }
                let card = this.cards[o.get('card_id')];
                this.cursorName = card.name;
                this.cursorScope = card.scopeName;
                break;
            case 'marker':
                let marker = this.cards[o.get('marker_id')];
                this.cursorName = marker.name;
                this.cursorScope = marker.scopeName;
                break;
            case 'book':
                let book = this.books[o.get('book_id')];
                this.cursorName = book.name;
                this.cursorScope = 'Book'; // todo - localization
                break;
            case 'dome':
                let dome = this.domes[o.get('dome_id')];
                let domeCard = this.cards[dome.scope_id];
                this.cursorName = domeCard.name;
                this.cursorScope = 'Dome'; // todo - localization
                break;
            case 'area':
                let area = this.areas[o.get('area_id')];
                let areaCard = this.cards[area.scope_id];
                this.cursorName = areaCard.name;
                this.cursorScope = 'Area'; // todo - localization
                break;
            default:
                console.error('Unknown object for cursor!', o);
        }
    },
    /**
     * @returns {?fabric.Fog}
     */
    _fog() {
        return this.fb().getObjects('fog')[0];
    },
    /**
     * @param {?string} skip
     * @private
     */
    _offModes(skip = null) {
        let modes = ['Erase', 'EraseUndo', 'Transform'];
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
    },
    /**
     * @param {Array} ids
     * @param {Object<string, number>|string} filter
     * @param {string} idsField
     * @return {Array}
     * @private
     */
    _filter(ids, filter, idsField) {
        if (typeof filter === 'string') {
            let temp = {}
            temp[filter] = this.activeInfo.id;
            filter = temp;
        }
        // console.log('Filtering...', filter, idsField);
        let filteredIds = [];
        for (let source in filter) {
            if (!this[source]) {
                throw new Error('Unknown filter source: ' + source);
            }
            let id = filter[source];
            let entity = this[source][id];
            if (!entity) {
                throw new Error('Filter entity not found!');
            }
            let entityIds = entity[idsField];
            if (!entityIds) {
                filteredIds = [];
            } else {
                ids.forEach(function(id) {
                    if (entityIds.includes(Number(id))) {
                        filteredIds.push(Number(id));
                    }
                });
            }
            ids = filteredIds;
        }
        // console.debug('Filtering result', ids);
        return ids;
    },
    _deckType(number) {
        let labels = ['Stack','Set','State','Control'];

        return labels[number];
    },
    findCard(id) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        return toRaw(this.cards[id]);
    },
    findArea(id) {
        if (!this.areas[id]) {
            throw new Error('Area not found: ' + id);
        }
        return toRaw(this.areas[id]);
    },
    findDome(id) {
        if (!this.domes[id]) {
            throw new Error('Dome not found: ' + id);
        }
        return toRaw(this.domes[id]);
    },
    /**
     * @param {string} type
     * @param {number} id
     * @param {boolean} show
     * @private
     */
    _visibility(type, id, show) {
        id = Number(id);
        console.debug('Set visibility', type, id, show);
        let idsField = 'visible' + type.charAt(0).toUpperCase() + type.slice(1) + 'Ids';
        if (show) {
            if (!this[idsField].includes(id)) {
                this[idsField].push(id);
            }
        } else {
            let index = this[idsField].indexOf(id);
            if (index !== -1) {
                this[idsField].splice(index, 1);
            }
        }
    },
    _data() {
        let fields = [
            'activeDomeId', 'activeSceneId', 'activeAreaId',
            'visibleDomeIds', 'visibleLandIds', 'visibleAreaIds', 'visibleSceneIds',
            'visibleBookIds','visibleDeckIds', 'visibleCardIds',
            'domes', 'lands', 'areas', 'scenes', 'books', 'decks', 'cards'
        ];
        let data = {};
        let self = this;
        fields.forEach(function(field) {
            data[field] = toRaw(self[field]);
        });

        return data;
    }
});
