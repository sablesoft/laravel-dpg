"use strict"

import {createItem, createRoom, processText, Link, random, settings} from "questjs-core";

const randomFeatures = [
    function(r) {
        r.desc += ' There is a clock on the wall.'
        createItem('clock_' + r.name, {
            alias:'clock',
            loc:r.name,
            scenery:true,
            examine:'It seems to have stopped at ' + random.int(1, 12) + ':' + random.int(10, 59) + '.',
        })
    },

    function(r) {
        r.desc += ' There is a curious stain on the floor.'
        createItem('stain_' + r.name, {
            alias:'curious stain',
            loc:r.name,
            scenery:true,
            examine:'Is that blood?',
        })
    },

    function(r) {
        r.desc += ' It smells of elderberries in here.'
        r.smell = 'Definitely elderberries. And not in a good way.'
    },
];

for (let i = 0; i < settings.maze_size; i++) {
    for (let j = 0; j < settings.maze_size; j++) {
        console.log('Create maze room', i, j);
        const r = createRoom("maze_" + i + "_" + j, {
            desc:processText("you are in a maze of {random:twisty:winding:snaking:meandering} {random:little passages:dark tunnels}, all alike."),
        })
        if (random.chance(10) && i < (settings.maze_size - 1) && j < (settings.maze_size - 1)) {
            r.east = new Link("maze_" + (i + 1) + "_" + j)
            r.north = new Link("maze_" + i + "_" + (j + 1))
        }
        else if ((random.chance(50) && i < (settings.maze_size - 1)) || j === settings.maze_size - 1) {
            r.east = new Link("maze_" + (i + 1) + "_" + j)
        }
        else {
            r.north = new Link("maze_" + i + "_" + (j + 1))
        }
        if (random.chance(10)) {
            randomFeatures[random.int(0, randomFeatures.length - 1)](r)
        }
    }
}

const lastName = "maze_" + settings.maze_size  + "_" + (settings.maze_size - 1);
console.log('last name', lastName);

createRoom(lastName, {
    desc:"You escaped the maze!",
});
