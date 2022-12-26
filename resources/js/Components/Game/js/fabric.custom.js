import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/js/game";

fabric.Group.prototype._item = function(type, required = true) {
    let item = this.getObjects(type)[0];
    if (!item && required) {
        console.error('Group item not found!', this, type);
        throw new Error('Group item not found!');
    }

    return item;
};

fabric.Group.prototype.showOpacity = 0.5;
fabric.Group.prototype.visibility = function(show = true) {
    this.show = show;
    if (show) {
        this.opacity = 1;
        this.visible = true;
    } else {
        if (game.isMaster()) {
            this.opacity = this.showOpacity;
        } else {
            this.visible = false;
        }
    }
    if (this.canvas) {
        this.canvas.requestRenderAll();
    }
};
