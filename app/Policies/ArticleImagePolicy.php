<?php

namespace App\Policies;

use App\ArticleImage;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any article images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the article image.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleImage  $articleImage
     * @return mixed
     */
    public function view(User $user, ArticleImage $articleImage)
    {
        //
    }

    /**
     * Determine whether the user can create article images.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the article image.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleImage  $articleImage
     * @return mixed
     */
    public function update(User $user, ArticleImage $articleImage)
    {
        //
    }

    /**
     * Determine whether the user can delete the article image.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleImage  $articleImage
     * @return mixed
     */
    public function delete(User $user, ArticleImage $imagen)
    {
        return $user->id === $imagen->article->user_id;
    }

    /**
     * Determine whether the user can restore the article image.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleImage  $articleImage
     * @return mixed
     */
    public function restore(User $user, ArticleImage $articleImage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article image.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleImage  $articleImage
     * @return mixed
     */
    public function forceDelete(User $user, ArticleImage $articleImage)
    {
        //
    }
}
