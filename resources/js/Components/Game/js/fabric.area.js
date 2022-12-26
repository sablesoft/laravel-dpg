import { fabric } from 'fabric-with-erasing';
import './fabric.custom';
import { game } from "@/Components/Game/js/game";

fabric.Area = fabric.util.createClass(fabric.Group, {
    type: 'area',
    defaultShowOpacity: 0.7,

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

        let area = id ? game.findArea(id) : game.findArea(options.area_id);
        let dome = game.findDome(area.dome_id);
        options.width = parseInt(dome.area_width);
        options.height = parseInt(dome.area_height);
        options.mask = Array.from(dome.area_mask || []);
        options.left = options.left || area.left;
        options.top = options.top || area.top;
        options.area_id = options.area_id || area.id;
        options.card_id = options.card_id || area.scope_id;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;
        if (!options.width || !options.height) {
            throw new Error('Area width and height required for fb object!');
        }

        options.lockMovementX = !game.isMaster();
        options.lockMovementY = !game.isMaster();

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        if (!id) {
            return;
        }

        let self = this;
        // todo update images for created objects
        fabric.Image.fromURL(area.image, function(image) {
            image.set('originX', 'center');
            image.set('originY', 'center');
            image.set('erasable', false);
            self.add(image);
        });
    },
    update() {
        let area = game.findArea(this.get('area_id'));
        this._item('image').setSrc(area.image, function(img) {
            if (img.canvas) {
                img.canvas.requestRenderAll();
            }
        });
        this.sendBackwards(true);
        // todo - update mask polygone
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }
    },
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
            area_id: this.get('area_id'),
            card_id: this.get('card_id'),
            mask: this.get('mask'), // todo - mask for checking cursor
        });
    },
    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});

fabric.Area.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let areaObject = new fabric.Area(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
           areaObject.add(o);
        });
    });
    callback(areaObject);

    return areaObject;
}
