import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/game";

fabric.Area = fabric.util.createClass(fabric.Group, {

    type: 'area',
    isMaster: false,
    defaultShowOpacity: 0.7,

    /**
     * @param {GameArea} model
     * @param {?Object.<string, any>} options
     */
    initialize: function(model, options) {
        this.isMaster = game.isMaster();
        options || (options = {});
        options.hasControls = false;
        options.hasBorders = false;
        options.lockMovementX = true;
        options.lockMovementY = true;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.erasable = false;
        options.hoverCursor = 'pointer';
        options.left = options.left || model.left;
        options.top = options.top || model.top;
        options.area_id = options.area_id || model.id;
        options.card_id = options.card_id || model.scope_id;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;
        if (!options.width || !options.height) {
            throw new Error('Area width and height required for fb object!');
        }
        options.width = parseInt(options.width);
        options.height = parseInt(options.height);

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        if (!model) {
            return;
        }

        let self = this;
        fabric.Image.fromURL(model.image, function(image) {
            image.set('originX', 'center');
            image.set('originY', 'center');
            image.set('erasable', false);
            self.add(image);
        });
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

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
            area_id: this.get('area_id'),
            card_id: this.get('card_id'),
            mask: this.get('mask'),
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
