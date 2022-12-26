import { fabric } from 'fabric-with-erasing';
import './fabric.custom';
import { game } from "@/Components/Game/game";

fabric.Marker = fabric.util.createClass(fabric.Group, {
    type: 'marker',
    defaultScale: 0.3,
    defaultShowOpacity: 0.5,

    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     */
    initialize: function(id, options) {
        options || (options = {});
        options.hasControls = false;
        options.hasBorders = false;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.erasable = false;
        options.hoverCursor = 'pointer';
        let card = id ? game.findCard(id) : game.findCard(options.marker_id);

        options.marker_id = options.marker_id || card.id;
        options.scope_id = options.scope_id || card.scope_id;
        options.imageScale = options.imageScale || this.defaultScale;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;

        options.lockMovementX = !game.isMaster();
        options.lockMovementY = !game.isMaster();

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        if (!id) {
            return;
        }
        let self = this;
        fabric.Image.fromURL(this._src(), function(image) {
            image.set('originX', 'center');
            let scale = Number(self.get('imageScale'));
            let width = Number(image.get('width'));
            let height = Number(image.get('height'));
            self.set('width', width * scale);
            self.set('height', height * scale);
            image.scale(scale);
            self.add(image);
        });
    },
    update() {
        // console.debug('Marker update', this);
        this._item('image').setSrc(this._src(), function(img) {
            if (img.canvas) {
                img.canvas.requestRenderAll();
            }
        });

        return this;
    },
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
            scope_id: this.get('scope_id'),
            marker_id: this.get('marker_id'),
            imageScale: this.get('imageScale')
        });
    },
    _render: function(ctx) {
        this.callSuper('_render', ctx);
    },
    _src: function() {
        let card = game.findCard(this.get('marker_id'));
        let src = card.image;
        if (card.scope_id) {
            src = game.findCard(card.scope_id).image;
        }
        if (!src) {
            throw new Error('Required image not found!');
        }

        return src;
    }
});

fabric.Marker.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let markerObject = new fabric.Marker(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
            markerObject.add(o);
        });
    });
    callback(markerObject);

    return markerObject;
}
