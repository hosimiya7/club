<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Club extends Model
{
    use HasFactory;

    const INSUFFICIENT = 0;
    const UNAPPROVED = 1;
    const APPROVED = 2;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'members');
    }

    public function isMemberInsufficient()
    {
        // tureだったら
        return $this->approval === self::INSUFFICIENT;
    }

    public function isUnApproved()
    {
        return $this->approval === self::UNAPPROVED;
    }

    public function isApproved()
    {
        return $this->approval === self::APPROVED;
    }

}
