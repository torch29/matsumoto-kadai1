<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Channel extends Model
{
    use HasFactory;

    public function contacts() {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

    public function getChannel(){
        return 'ID'. $this->id . ':' . $this->content;
    }

}
