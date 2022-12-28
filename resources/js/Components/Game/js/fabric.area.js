import { fabric } from 'fabric-with-erasing';
import './fabric.custom';
import { game } from "@/Components/Game/js/game";

fabric.Area = fabric.util.createClass(fabric.Group, {
    type: 'area',
    defaultShowOpacity: 0.7,
    subTargetCheck: true,

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
        fabric.Image.fromURL(area.image, function(image) {
            image.set('originX', 'center');
            image.set('originY', 'center');
            image.set('erasable', false);
            self.add(image);
            let polygonOptions = {
                originX: 'center',
                originY: 'center',
                fill: 'rgba(255,255,255,0)',
                stroke: 'rgba(255,255,255,0)',
                strokeWidth: 7,
                strokeDashArray: [50, 80] // 190
            };
            if (options.mask) {
                let points = [];
                let mask = Array.from(options.mask);
                let pair = [];
                while (mask.length) {
                    pair = mask.splice(0,2);
                    points.push({
                        x: pair[0] - options.width/2,
                        y: pair[1] - options.height/2
                    });
                }
                self.add(new fabric.Polygon(points, polygonOptions));
            } else {
                self.add(new fabric.Polygon([{
                    x: -options.width/2,
                    y: -options.height/2
                }, {
                    x: options.width/2,
                    y: -options.height/2
                }, {
                    x: options.width/2,
                    y: options.height/2
                }, {
                    x: -options.width/2,
                    y: options.height/2
                }], polygonOptions));
            }
        });
    },
    activate(activate = true) {
        let polygon = this._item('polygon');
        if (activate) {
            polygon.set('stroke', 'rgba(255,0,234,1)');
        } else {
            polygon.set('stroke', 'rgba(255,255,255,0)');
        }
        this.canvas && this.canvas.requestRenderAll();
    },
    onArea(point) {
        let center = this.getCenterPoint();
        let polygon = this._item('polygon');
        let ax = [], ay = [];
        polygon.points.forEach(function(p) {
            ax.push(p.x + center.x);
            ay.push(p.y + center.y);
        });
        // console.debug('Check polygon points', ax, ay, point);

        return this._pointCheck(polygon.points.length, ax, ay, point.x, point.y);
    },
    /**
     * @param {number} pointsCount
     * @param {Array} ax
     * @param {Array} ay
     * @param {number} x
     * @param {number} y
     * @return {number}
     * @private
     */
    _pointCheck(pointsCount, ax, ay, x, y) {
        let i, j, c = 0;
        for (i = 0, j = pointsCount - 1; i < pointsCount; j = i++) {
            if (((ay[i] > y) !== (ay[j] > y)) &&
                (x < (ax[j] - ax[i]) * (y - ay[i]) / (ay[j] - ay[i]) + ax[i])) {
                c = !c;
            }
        }
        return c;
    },
    update() {
        let area = game.findArea(this.get('area_id'));
        this._item('image').setSrc(area.image, function(img) {
            img.canvas && img.canvas.requestRenderAll();
        });
        this.sendBackwards(true);
        // todo - update mask polygon
        this.canvas && this.canvas.requestRenderAll();
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
