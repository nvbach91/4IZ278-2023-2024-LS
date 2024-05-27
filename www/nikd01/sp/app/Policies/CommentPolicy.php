<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can delete the Rating.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->is_admin || $user->id === $comment->user_id || $user->id === $comment->material->user_id;
    }
}
