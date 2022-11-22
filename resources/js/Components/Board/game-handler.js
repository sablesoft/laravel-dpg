var gameHandler = gameHandler || { version: '0.0.1' };

export default gameHandler;

gameHandler.defaultLocale = 'en';
gameHandler.locale = gameHandler.defaultLocale;
gameHandler.game = null;
gameHandler.book = null;
gameHandler.cards = null;

gameHandler._locale = function(data) {
    if (!data) {
        return null;
    } else if (!data[this.locale]) {
        return data[this.defaultLocale];
    }

    return data[this.locale];
}

gameHandler.init = function(game, locale) {
    this.locale = locale || this.locale;
    this.game = {
        name: this._locale(game.name),
        desc: this._locale(game.desc),
        scope_name: game.scope_name,
        hero_id: game.hero_id,
        quest_id: game.quest_id,
        board_image: game.board_image
    };
    this.book = {
        name: this._locale(game.book.name),
        desc: this._locale(game.book.desc),
        image: game.book.image,
        cards_back: game.book.cards_back
    }
    this.cards = game.book.collection;
};

gameHandler.getGameCard = function() {
    if (!this.game || !this.book) {
        return null;
    }
    return {
        name : this.game.name,
        desc : this.game.desc,
        scope_name : this.game.scope_name,
        image : '/storage/' + this.book.image
    }
}
gameHandler.getCard = function(cardId) {
    let card = this.cards[cardId];
    card.name = this._locale(card.name);
    card.scope_name = this._locale(card.scope_name);
    card.desc = this._locale(card.desc);
    card.image = '/storage/' + card.image;

    return card;
};
gameHandler.getHero = function() {
    return this.getCard(this.game.hero_id);
}
gameHandler.getQuest = function() {
    return this.getCard(this.game.quest_id);
}
