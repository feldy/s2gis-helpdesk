<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IssueHdrModel extends Model
{
    protected $table = 'hd_issue_hdr';
    public $incrementing = false;

    public function details() {
        return $this->hasMany('App\Model\IssueDtlModel', 'issue_id');

    }
}
