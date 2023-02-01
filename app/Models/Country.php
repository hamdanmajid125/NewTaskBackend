<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Country extends Model
{
    use LogsActivity;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sortname', 'name', 'phonecode'];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */

   public function posts()
   {
        return $this->hasMany(Post::class,'country','id');
   }
}
