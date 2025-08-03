<?php

namespace App\Policies;

use App\Models\BlogComment;
use App\Models\User;

class BlogCommentPolicy
{
    // User harus login untuk buat komentar
    public function create(User $user)
    {
        return $user !== null;
    }

    // Contoh lain: hanya pemilik komentar yang boleh hapus
    public function delete(User $user, BlogComment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
