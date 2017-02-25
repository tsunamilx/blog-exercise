<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Post
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Post whereUserId($value)
 * @method static Builder|Post whereBody($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @property-read \App\User $author
 * @property-read Collection|Tag[] $tags
 * @property-read Collection|Comment[] $comments
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Post extends Model {

    const ITEM_PER_PAGE = 10;

    protected $fillable = [
        'title',
        'body',
    ];

    /**
     * Loads a listing of posts by page.
     *
     * @param int $page
     * @return \Illuminate\Support\Collection
     */
    public static function loadPage($page = 0) {
        return Post::latest()
                    ->with('tags')
                    ->with('user')
                   ->take(self::ITEM_PER_PAGE)
                   ->offset($page * self::ITEM_PER_PAGE)
                   ->get();
    }

    /**
     * Checks if current user is the owner of the post.
     *
     * @return bool
     */
    public function isOwner() {
        if (auth()->guest()) {
            return false;
        }
        return $this->user_id == auth()->user()->id;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->with('user');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

}
