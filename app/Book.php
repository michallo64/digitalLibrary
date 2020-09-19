<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Book
 *
 * @property int $id
 * @property string $title
 * @property string $isbn
 * @property float $price
 * @property int $category_id
 * @property Author $author
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Book newModelQuery()
 * @method static Builder|Book newQuery()
 * @method static Builder|Book query()
 * @method static Builder|Book whereAuthor($value)
 * @method static Builder|Book whereCategoryId($value)
 * @method static Builder|Book whereCreatedAt($value)
 * @method static Builder|Book whereId($value)
 * @method static Builder|Book whereIsbn($value)
 * @method static Builder|Book whereTitle($value)
 * @method static Builder|Book wherePrice($value)
 * @method static Builder|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $author_id
 * @property-read \App\Category $category
 * @method static Builder|Book whereAuthorId($value)
 */
class Book extends Model
{
    protected $fillable = [
        'title', 'isbn', 'price', 'category_id', 'author_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function author(){
        return $this->belongsTo('App\Author');
    }
}
