<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates=['published_at'];
    protected $fillable = ['title','slug','excerpt','body','published_at','category_id','image'];
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDateAttribute()
    {
        return is_null($this->published_at)? '' :$this->published_at->diffForHumans();
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value? : NULL;
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body? Markdown::convertToHtml(e($this->body)): NULL;
    }

    public function getExcerptHtmlAttribute()
    {
        return $this->excerpt? Markdown::convertToHtml(e($this->excerpt)): NULL;
    }

    public function scopePublished($query)
    {
        return $query->where("published_at","<=", Carbon::now());
    }

    public function dateFormatted($showTimes=false)
    {
        $format='d/m/y';
        if ($showTimes){
            $format=$format . "H.i.s";
        }
        return $this->created_at->format($format);


    }

    public function publicationLabel()
    {
        if (! $this->published_at){
            return '<span class="label label-warning">Draft</span>';
        }
        elseif ($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }
        else{
            return'<span class="label label-success">Published</span>';
        }
    }
}
