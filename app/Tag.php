<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model {

    protected $fillable = ['name'];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    /**
     *  Finds the tag ids or create them.
     *
     * @param string $tags Tag names separated by comma。
     * @return array
     */
    public static function findOrCreate($tags) {

        $return = [];

        $tags = explode(',', $tags);
        foreach ($tags as $name) {
            $name = strtolower(trim($name));
            $t = Tag::whereName($name)->first();
            if ($t) {
                $return[] = $t->id;
            } else {
                $t = Tag::create(['name' => $name]);
                $return[] = $t->id;
            }
        }

        return $return;
    }
}
