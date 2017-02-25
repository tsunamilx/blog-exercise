<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $from_user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Message whereBody($value)
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereFromUserId($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereUpdatedAt($value)
 * @method static Builder|Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model {

    /**
     * Finds the messages those are for me.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function findMyMessages() {
        return Message::whereUserId(auth()->user()->id)->get();
    }

}
