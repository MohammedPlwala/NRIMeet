<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Corals\Foundation\Transformers\PresentableTrait;
use Corals\Foundation\Traits\Node\SimpleNode;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Permissions extends Model
{
    protected $table = 'permissions';
}
