<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $from_user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereFromUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    //
}
