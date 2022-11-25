<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;
use App\Models\Content;

class CardPolicy extends ContentPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Content $content
     * @return mixed
     */
    public function view(User $user, Content $content): bool
    {
        /** @var Card $content */
        return (parent::view($user, $content) ||
            $this->isBookSubscriber($user, $content));
    }

    /**
     * @param User $user
     * @param Card $card
     * @return bool
     */
    protected function isBookSubscriber(User $user, Card $card): bool
    {
        $query = $card->books()->whereHas('subscribers', function($query) use ($user) {
            $query->where('subscriber_id', $user->getKey());
        });
        return $query->exists();
    }
}
