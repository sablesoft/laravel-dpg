import { fabric } from 'fabric-with-erasing';

fabric.Card = fabric.util.createClass(fabric.Group, {

    type: 'card',
    defaultWidth: 100,
    defaultRatio: 1.4,
    defaultOpened: false,
    defaultTapped: false,

    /**
     * @param {GameCard} model
     * @param {?Object.<string, any>} options
     */
    initialize: function(model, options) {
        options || (options = {});
        options.hasControls = false;
        options.hasBorders = false;
        options.hoverCursor = 'pointer';
        options.opened = options.opened !== undefined ? options.opened : this.defaultOpened;
        options.tapped = options.tapped !== undefined ? options.tapped : this.defaultTapped;
        options.width = options.width || this.defaultWidth;
        options.ratio = options.ratio || this.defaultRatio;
        options.height = options.width * options.ratio;
        options.centeredRotation = true;
        options.card_id = model.id;
        options.scope_id = model.scope_id;

        this.callSuper('initialize', [], options);

        this.add(new fabric.Rect({
            partType: 'body',
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
        this.add(new fabric.Text(model.name, {
            partType: 'name',
            originX: 'center',
            top: -60,
            fontSize: 12,
            fontWeight: 'bold',
            fill: 'black',
        }));
        if (model.scopeName) {
            this.add(new fabric.Text(model.scopeName, {
                partType: 'scopeName',
                originX: 'center',
                top: 46,
                fontSize: 12,
                fontWeight: 'normal',
                fill: 'black',
            }));
        }

        let self = this;
        if (model.image) {
            fabric.Image.fromURL(model.image, function(image) {
                image.scale(0.3);
                image.set('originX', 'center');
                image.set('top', -37);
                image.set('partType', 'image');
                self.add(image);
            });
        }
        fabric.Image.fromURL(options.back_image, function(back) {
            back.set('originX', 'center');
            back.set('originY', 'center');
            back.set('partType', 'back');
            self.add(back);
            back.bringToFront();
            if (self.get('opened')) {
                back.set('opacity', 0);
            }
        });
        this.on('mousedown', function() {
            const shadow = new fabric.Shadow({
                color: "rgba(0,0,0,0.8)",
                blur: 15,
                offsetX: 5,
                offsetY: 5
            });
            this.set('shadow', shadow);
        });
        this.on('mouseup', function() {
            this.set('shadow', null);
        });
        if (this.get('tapped')) {
            this.tap(true);
        }
    },

    flip: function () {
        let opened = this.get('opened');
        this.set('opened', !opened);
        this.forEachObject(function(item) {
            if (item.partType === 'back') {
                item.set('opacity', opened ? 1 : 0);
                item.bringToFront();
            }
        });
        this.set('dirty', true);
        this.canvas && this.canvas.requestRenderAll();
    },

    tap: function (force = false) {
        if (this.get('tapped') && !force) {
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
            card_id: this.get('card_id'),
            ratio: this.get('ratio'),
            tapped: this.get('tapped'),
            opened: this.get('opened')
        });
    },

    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});
