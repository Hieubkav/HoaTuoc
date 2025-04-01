<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Xử lý trước khi tạo post
     */
    public function creating(Post $post): void
    {
        if (empty($post->slug)) {
            $post->slug = $this->createUniqueSlug($post->title);
        }

        if (empty($post->status)) {
            $post->status = 'hidden';
        }
    }

    /**
     * Xử lý trước khi cập nhật post
     */
    public function updating(Post $post): void
    {
        if ($post->isDirty('title') && empty($post->slug)) {
            $post->slug = $this->createUniqueSlug($post->title);
        }
    }

    /**
     * Tạo slug duy nhất từ title
     */
    private function createUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
