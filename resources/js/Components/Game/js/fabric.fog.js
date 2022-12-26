import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/js/game";

fabric.Fog = fabric.util.createClass(fabric.Rect, {
    type: 'fog',
    defaultFill: 'white',
    defaultShowOpacity: 0.5,
    isMaster: false,

    /**
     * @param {Object.<string, any>} options
     */
    initialize: function(options) {
        if (!options.width || !options.height) {
            throw new Error('Width and height are required for fog!');
        }
        this.isMaster = game.isMaster();
        options.erasable = true;
        options.hoverCursor = 'default';
        options.hasBorders = false;
        options.hasControls = false;
        options.lockMovementX = true;
        options.lockMovementY = true;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.originX = 'left';
        options.originY = 'top';
        options.evented = false;
        options.stroke = null;
        options.fill = options.fill || this.defaultFill;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.opacity = this.isMaster ? options.showOpacity : 1;

        this.callSuper('initialize', options);
    },

    preview(enable = true) {
        this.opacity = enable ? 1 : this.showOpacity;
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }
    },
});

fabric.Fog.fromObject = function(object, callback) {
    return fabric.Object._fromObject('Fog', object, callback);
}
