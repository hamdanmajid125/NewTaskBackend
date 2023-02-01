<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Post extends Model
{
    use LogsActivity;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

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
    protected $fillable = ['name', 'description', 'user_id', 'status','available_id','type','country_id','pay'];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class,'available_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function job_types()
    {
        return $this->belongsTo(JobType::class,'type');
    }


    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
