<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Content;
use App\Models\User;

class BookPolicy extends ContentPolicy
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
        /** @var Book $content */
        return parent::view($user, $content)
            || $content->hasSubscriber($user);
    }

    /**
     * Determine whether the user can attach any subscriber to the content.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function attachAnyUser(User $user, Book $book): bool
    {
        return $user->isAdmin() ||
            $user->isOwner($book);
    }

    /**
     * Determine whether the user can attach tag to the content.
     *
     * @param User $user
     * @param Book $book
     * @param User $subscriber
     * @return bool
     */
    public function attachUser(User $user, Book $book, User $subscriber): bool
    {
        return $user->isAdmin() || $user->isOwner($book);
    }


    /**
     * Determine whether the user can detach tag from the content.
     *
     * @param User $user
     * @param Book $book
     * @param User $subscriber
     * @return bool
     */
    public function detachUser(User $user, Book $book, User $subscriber): bool
    {
        return $user->isAdmin() || $user->isOwner($book);
    }

    /**
     * Determine whether the user can add tag to the content.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function addUser(User $user, Book $book): bool
    {
        return $user->isAdmin() || $user->isOwner($book);
    }
}
