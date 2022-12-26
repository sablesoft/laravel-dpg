import { fabric } from 'fabric-with-erasing';

fabric.Back = fabric.util.createClass(fabric.Image, {
    type: 'back',
});

/**
 * Creates an instance of fabric.Back from its object representation
 * @static
 * @param {Object} _object Object to create an instance from
 * @param {Function} callback Callback to invoke when an image instance is created
 */
fabric.Back.fromObject = function(_object, callback) {
    let object = fabric.util.object.clone(_object);
    fabric.util.loadImage(object.src, function(img, isError) {
        if (isError) {
            callback && callback(null, true);
            return;
        }
        fabric.Image.prototype._initFilters.call(object, object.filters, function(filters) {
            object.filters = filters || [];
            fabric.Image.prototype._initFilters.call(object, [object.resizeFilter], function(resizeFilters) {
                object.resizeFilter = resizeFilters[0];
                fabric.util.enlivenObjectEnlivables(object, object, function () {
                    let image = new fabric.Back(img, object);
                    callback(image, false);
                });
            });
        });
    }, null, object.crossOrigin);
};

/**
 * Creates an instance of fabric.Back from an URL string
 * @static
 * @param {String} url URL to create an image from
 * @param {Function} [callback] Callback to invoke when image is created (newly created image is passed as a first argument). Second argument is a boolean indicating if an error occurred or not.
 * @param {Object} [imgOptions] Options object
 */
fabric.Back.fromURL = function(url, callback, imgOptions) {
    fabric.util.loadImage(url, function(img, isError) {
        callback && callback(new fabric.Back(img, imgOptions), isError);
    }, null, imgOptions && imgOptions.crossOrigin);
};
