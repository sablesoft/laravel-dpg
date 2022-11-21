import { fabric } from 'fabric';

fabric.Card = fabric.util.createClass(fabric.Group, {

    type: 'card',
    defaultWidth: 110,
    defaultRatio: 1.4,

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

        const rectangle = new fabric.Rect({
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
            // shadow: shadow,
        });
        const title = new fabric.Text(model.name, {
            originX: 'center',
            top: -70,
            fontSize: 12,
            fontWeight: 'bold',
            fill: 'black',
        });

        this.callSuper('initialize', [rectangle, title], options);

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

        this.on('mousedblclick', function() {
            console.log('Double click!');
        })
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
