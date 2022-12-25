import { fabric } from 'fabric-with-erasing';
import './fabric.back';
import './fabric.name';
import './fabric.scope-name';
import { game } from "@/Components/Game/game";

fabric.Card = fabric.util.createClass(fabric.Group, {

    type: 'card',
    defaultWidth: 100,
    defaultRatio: 1.4,
    defaultOpened: false,
    defaultTapped: false,
    defaultShowOpacity: 0.7,
    isMaster: false,

    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     */
    initialize: function(id, options) {
        this.isMaster = game.isMaster();
        options || (options = {});
        options.hasControls = false;
        options.hasBorders = false;
        options.hoverCursor = 'pointer';
        options.centeredRotation = true;
        options.opened = options.opened !== undefined ? options.opened : this.defaultOpened;
        options.tapped = options.tapped !== undefined ? options.tapped : this.defaultTapped;
        options.width = options.width || this.defaultWidth;
        options.ratio = options.ratio || this.defaultRatio;
        options.height = options.width * options.ratio;
        let card = id ? game.findCard(id) : game.findCard(options.card_id);

        options.card_id = options.card_id || card.id;
        options.scope_id = card.scope_id;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        let self = this;
        this.on('mousedown', function() {
            const shadow = new fabric.Shadow({
                color: "rgba(0,0,0,0.8)",
                blur: 15,
                offsetX: 5,
                offsetY: 5
            });
            self.set('shadow', shadow);
        });
        this.on('mouseup', function() {
            self.set('shadow', null);
        });
        if (this.get('tapped')) {
            this.tap(true);
        }

        this.visibility(this.show);

        if (!id) {
            this.updateContent();
            return;
        }

        this.add(new fabric.Rect({
            originX: 'center',
            originY: 'center',
            fill: 'white',
            width: this.get('width'),
            height: this.get('height'),
            rx: 10,
            ry: 10,
            stroke: 'black',
            strokeLineCap: 'round',
            strokeLineJoin: 'round',
        }));
        this.add(new fabric.Name(card.currentName, {
            originX: 'center',
            top: -60,
            fontSize: 12,
            fontWeight: 'bold',
            fill: 'black',
        }));
        if (card.scopeName) {
            this.add(new fabric.Text(game.getCardName(card.scope_id), {
                originX: 'center',
                top: 46,
                fontSize: 12,
                fontWeight: 'normal',
                fill: 'black',
            }));
        }

        if (card.image) {
            fabric.Image.fromURL(card.image, function(image) {
                image.scale(0.3);
                image.set('originX', 'center');
                image.set('top', -37);
                self.add(image);
            });
        }
        fabric.Back.fromURL(game.cardsBack, function(back) {
            back.set('originX', 'center');
            back.set('originY', 'center');
            self.add(back);
            back.bringToFront();
            if (self.get('opened')) {
                back.set('opacity', 0);
            }
        });
    },

    updateContent() {
        let card = game.findCard(this.get('card_id'));
        // update back image:
        let back = this.getObjects('back')[0];
        back.setSrc(game.cardsBack, function(img) {
            if (img.canvas) {
                img.canvas.requestRenderAll();
            }
        });
        // update image:
        let image = this.getObjects('image')[0];
        if (image) {
            image.setSrc(card.image, function(img) {
                if (img.canvas) {
                    img.canvas.requestRenderAll();
                }
            });
        }
        // update name:
        let name = this.getObjects('name')[0];
        name.setText(card.currentName);
        // update scope name:
        let scope = this.getObjects('scopeName')[0];
        if (scope) {
            scope.setText(game.getCardName(card.scope_id));
        }

        return this;
    },

    visibility: function(show = true) {
        this.show = show;
        if (show) {
            this.opacity = 1;
            this.visible = true;
        } else {
            if (this.isMaster) {
                this.opacity = this.showOpacity;
            } else {
                this.visible = false;
            }
        }
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }
    },

    flip: function () {
        if (!this.isMaster) {
            console.log('Flip cards can only master!');
            return;
        }
        let opened = this.get('opened');
        this.set('opened', !opened);
        let back = this.getObjects('back')[0];
        back.set('opacity', opened ? 1 : 0);
        back.bringToFront();
        this.set('dirty', true);
        this.canvas && this.canvas.requestRenderAll();
    },

    tap: function (force = false) {
        if (this.get('tapped') && !force) {
            console.log('Already tapped! Skip!');
            return false;
        }
        this.set('tapped', true);
        this.rotate(-90);
        this.set('dirty', true);
        this.canvas && this.canvas.requestRenderAll();
        return true;
    },

    untap: function() {
        if (!this.get('tapped')) {
            console.log('Already untapped! Skip!');
            return false;
        }
        this.set('tapped', false);
        this.rotate(0);
        this.set('dirty', true);
        this.canvas.requestRenderAll();
        return true;
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
            card_id: this.get('card_id'),
            scope_id: this.get('scope_id'),
            ratio: this.get('ratio'),
            tapped: this.get('tapped'),
            opened: this.get('opened')
        });
    },

    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});

fabric.Card.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let cardObject = new fabric.Card(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
            cardObject.add(o);
        });
    });
    callback(cardObject);

    return cardObject;
}
