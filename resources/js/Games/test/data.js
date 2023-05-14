"use strict"

// ============================
// Player
// ============================

import {
    COMPONENT, CONTAINER, NPC, OPENABLE, PLAYER, SWITCHABLE, TAKEABLE, WEARABLE, LOCKED_DOOR, LOCKED_WITH, KEY,
    createItem, createRoom, falsemsg, msg, formatList,
    Exit, lang, w, Link, world, tp, INDEFINITE
} from "questjs-core";

// export default function () {

    createItem("me", PLAYER(), {
      loc:"lounge",
      synonyms:['me', 'myself'],
      examine: "The most ordinary guy",
    });

    // ============================
    // Lounge
    // ============================

    createRoom("lounge", {
      east: new Link("kitchen"),
      // down: new Exit('maze_0_0'),
      desc: "A smelly room with an old settee and a {popup:tv:It looks like this TV is broken...}.",
      mapColour:'red',
      mapWidth:45,
      mapHeight:45,
    });

    // NPC:
    createItem("Lara", NPC(true), {
      loc:"lounge",
      examine:"A normal-sized rabbit.",
    })

    // Items:
    createItem("coin", TAKEABLE(),  {
      loc:"lounge",
      examine: "A gold coin.",
    });
    createItem("ornate_doll", TAKEABLE(), {
      loc:"glass_cabinet",
      examine:"A fancy doll, eighteenth century.",
    });
    createItem("boots", WEARABLE(), {
      loc:"lounge",
      pronouns: lang.pronouns.plural,
      examine:"Some old boots.",
    });
    createItem("torch", TAKEABLE(), SWITCHABLE(false, 'providing light'), {
      loc:"lounge",
      examine:"A small red torch.",
      synonyms:["flashlight"],
      lightSource:function() {
        return this.switchedon ? world.LIGHT_FULL : world.LIGHT_NONE
      },
      eventPeriod:1,
      eventIsActive:function() {
        return this.switchedon
      },
      eventScript:function() {
        this.power--;
        if (this.power === 2) {
          msg("The torch flickers.")
        }
        if (this.power < 0) {
          msg("The torch flickers and dies.{once: Perhaps there is a charger in the garage?}");
          this.doSwitchoff()
        }
      },
      testSwitchOn () {
        if (this.power < 0) {
          msg("The torch is dead.")
          return false
        }
        return true
      },
      power: 3,
      charge:function(options) {
        if (options.char.loc !== "garage") return falsemsg("There is nothing to charge the torch with here.")

        msg("{pv:char:charge:true} the torch - it should last for hours now.", options)
        this.power = 20
        return true
      },
    });
    createItem("glass_cabinet", CONTAINER(true), LOCKED_WITH("cabinet_key"), {
      examine:"A cabinet with a glass front.",
      loc:"lounge",
      transparent:true,
    });
    createItem("garage_key", KEY(), {
      loc:"lounge",
      examine: "A big key.",
    })

    // ============================
    // Kitchen
    // ============================

    createRoom("kitchen", {
      desc:'A clean room.',
      north:new Link("garage"),
      down:new Exit('basement', {
        isHidden:function() { return w.trapdoor.closed; },
      }),
      afterEnterFirst:function() {
        msg("A fresh smell here!")
      },
      exit_locked_north:true,
    });

    // Way:
    createItem("garage_door", LOCKED_DOOR("garage_key", "kitchen", "garage"), {
      examine: "The door to the garage.",
    })

    // Items:
    createItem("trapdoor", OPENABLE(false), {
      loc:"kitchen",
      examine:"A small trapdoor in the floor.",
    })

    // ============================
    // Garage
    // ============================

    createRoom("garage", {
      desc:'An empty garage.',
    });

    // Items:
    createItem("cabinet_key", KEY(), {
      loc:"garage",
      examine: "A small brass key."
    });
    createItem("charger", {
      loc:"garage",
      examine: "A device bigger than a washing machine to charge a torch? It has a compartment and a button. {charger_state}.",
    });
    createItem("charger_compartment", COMPONENT("charger"), CONTAINER(true), {
      alias:"compartment",
      examine:"The compartment is just the right size for the torch. It is {if:charger_compartment:closed:closed:open}.",
      testDropIn:function(options) {
        const contents = w.charger_compartment.getContents();
        if (contents.length > 0) return falsemsg("The compartment is full.")

        return true
      },
    });
    createItem("charger_button", COMPONENT("charger"), {
      examine:"A big red button.",
      alias:"button",
      push:function(options) {
        if (!w.charger_compartment.closed || w.torch.loc !== "charger_compartment") return falsemsg("{pv:char:push:true} the button, but nothing happens.", options)

        msg("{pv:char:push:true} the button. There is a brief hum of power, and a flash.", options)
        w.torch.power = 20
        return true
      },
    });
    tp.addDirective("charger_state", function() {
      if (w.charger_compartment.closed) {
        return "The compartment is closed"
      }
      const contents = w.charger_compartment.getContents()
      if (contents.length === 0) {
        return "The compartment is empty"
      }
      return "The compartment contains " + formatList(contents, {article:INDEFINITE, lastJoiner:'and'})
    })

    // ============================
    // Basement
    // ============================

    createRoom("basement", {
      desc:"A dank room, with piles of crates everywhere.",
      darkDesc:"It is dark, but you can just see the outline of the trapdoor above you.",
      up:new Exit('kitchen', {
        illuminated:true,
      }),
      lightSource:function() {
        return w.light_switch.switchedon ? world.LIGHT_FULL : world.LIGHT_NONE;
      },
    });

    // Items:
    createItem("light_switch", SWITCHABLE(false), {
      loc:"basement",
      alias:"light switch",
      examine:"A switch, presumably for the light.",
    });

// }
