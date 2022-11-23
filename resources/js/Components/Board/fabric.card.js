import { fabric } from 'fabric';

fabric.Card = fabric.util.createClass(fabric.Group, {

    type: 'card',
    defaultWidth: 100,
    defaultRatio: 1.4,
    defaultOpened: false,
    defaultTapped: false,

    // initialize can be of type function(options) or function(property, options), like for text.
    // no other signatures allowed.
    initialize: function(model, options) {
        options || (options = { });
        options.hasControls = false;
        options.hoverCursor = 'pointer';

        this.set('model', model);
        this.set('width', options.width || this.defaultWidth);
        this.set('ratio', options.ratio || this.defaultRatio);
        this.set('height', this.get('width') * this.get('ratio'));
        this.set('centeredRotation', true);
        this.set('opened', options.opened ? options.opened : this.defaultOpened);
        this.set('tapped', options.tapped ? options.tapped : this.defaultTapped);

        const body = new fabric.Rect({
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
        });
        const name = new fabric.Text(model.name, {
            partType: 'name',
            originX: 'center',
            top: -60,
            fontSize: 12,
            fontWeight: 'bold',
            fill: 'black',
        });
        let items = [body, name];

        if (model.scope_name) {
            const scopeName = new fabric.Text(model.scope_name, {
                partType: 'scope_name',
                originX: 'center',
                top: 46,
                fontSize: 12,
                fontWeight: 'normal',
                fill: 'black',
            });
            items.push(scopeName);
        }

        this.callSuper('initialize', items, options);

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

        fabric.Image.fromURL(model.back_image, function(back) {
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
        this.canvas.requestRenderAll();
    },

    tap: function () {
        if (this.get('tapped')) {
            return;
        }
        this.set('tapped', true);
        this.rotate(-90);
        this.set('dirty', true);
        this.canvas.requestRenderAll();
    },

    untap: function() {
        if (!this.get('tapped')) {
            return;
        }
        this.set('tapped', false);
        this.rotate(0);
        this.set('dirty', true);
        this.canvas.requestRenderAll();
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            model: this.get('model'),
            width: this.get('width'),
            height: this.get('height'),
            ratio: this.get('ratio'),
        });
    },

    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});
