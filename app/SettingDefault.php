<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class SettingDefault extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['text','value'];
}
