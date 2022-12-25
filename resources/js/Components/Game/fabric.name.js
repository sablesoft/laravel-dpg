import { fabric } from 'fabric-with-erasing';

fabric.Name = fabric.util.createClass(fabric.Text, {
    type: 'name',
});

fabric.Name.fromObject = function(object, callback) {
    fabric.Object._fromObject('Name', object, callback);
}
