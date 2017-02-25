<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Post
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Post whereBody($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\User $user
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->with('user');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function isOwner() {
        return $this->user_id == auth()->user()->id;
    }
}
