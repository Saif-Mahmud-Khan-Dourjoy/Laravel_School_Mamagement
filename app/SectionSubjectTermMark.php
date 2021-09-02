<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionSubjectTermMark extends Model
{
    protected $fillable = [
         'section_subject_teacher_id', 'total_mark', 'pass_mark', 'wt_mark', 'ht_mark', 'wt_convert_in', 'ht_convert_in'
    ];

     public function section_subject_distribution() {
        return $this->hasOne('App\SectionSubjectDistribution');
    }

}
