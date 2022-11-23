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
        image: '/storage/' + game.book.image,
        cards_back: '/storage/' + game.book.cards_back
    }
    this.cards = game.book.collection;
};
gameHandler.getCardBack = function() {
    if (!this.book) {
        return null;
    }

    return this.book.cards_back;
}
gameHandler.getBoardImage = function() {
    if (!this.game) {
        return null;
    }
    return '/storage/' + this.game.board_image;
}
gameHandler.getGameCard = function() {
    if (!this.game || !this.book) {
        return null;
    }
    return {
        name : this.game.name,
        desc : this.game.desc,
        scope_name : this.game.scope_name,
        scope_image : null,
        image : this.book.image
    }
}
gameHandler.getCard = function(cardId) {
    if (!this.game || !this.book || !cardId) {
        return null;
    }

    let card = this.cards[cardId];
    card.name = this._locale(card.name);
    card.scope_name = this._locale(card.scope_name);
    const scopeCard = this.cards[card.scope_id];
    card.scope_image = scopeCard && scopeCard.image ?
        '/storage/' + scopeCard.image : null;
    card.desc = this._locale(card.desc);
    card.image = '/storage/' + card.image;
    card.back_image = this.book.cards_back;

    return card;
};
gameHandler.getHero = function() {
    return this.getCard(this.game.hero_id);
}
gameHandler.getQuest = function() {
    return this.getCard(this.game.quest_id);
}
