<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CollectedFees extends Model
{
    protected $fillable = [
    	'invoice_id', 
        'collector_id', 
        'section_student_id', 
        'payment_method_id', 
        'fees_book_leaf_number',
    	'collection_date', 
        'total_collected', 
        'total_advanced', 
        'total_due', 
        'student_id'
    ];

    // public static function boot(){
    //     parent::boot();
    //     self::creating(function ($model){
    //         $model->invoice_id = IdGenerator::generate(['table' => $this->table, 'length' => 6, 'prefix' => date('y')]);
    //     });
    // }

    public function section_student() {
    	return $this->belongsTo('App\SectionStudent');
    }

    public function payment_method() {
    	return $this->belongsTo('App\PaymentMethod');
    }

    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
    }

    public function business_month(){
        return $this->belongsTo('App\BusinessMonth');
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = "", $status = 0, $where = []){
        $totalData = $this::query();
        $filterData = $this::query();
        //dd($totalData);
        if ($status == 1){
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1) {
            $limit = 999999;
        }

        
        $totalData = $totalData->where('students.name', 'like', $search.'%')
        ->orWhere('collected_fees.collection_date', 'like', $search.'%')
        ->orWhere('collected_fees.total_collected', 'like', $search.'%')
        ->orWhere('section_students.roll', 'like', $search.'%')
        ->orWhere('sections.section_name', 'like', $search.'%')
        ->orWhere('levels.class_name', 'like', $search.'%')
        ->orWhere('business_months.month_name', 'like', $search.'%')
        ->orWhere('collected_fees.fees_book_leaf_number', 'like', $search.'%')
        ->join('students', 'students.id', '=', 'collected_fees.student_id')
        ->join('section_students', 'section_students.id', '=', 'collected_fees.section_student_id')
        ->join('sections', 'sections.id', '=', 'section_students.section_id')
        ->join('level_enrolls', 'level_enrolls.id', '=', 'sections.level_enroll_id')
        ->join('business_months', 'collected_fees.business_month_id', '=', 'business_months.id')
        ->join('levels', 'levels.id', '=', 'level_enrolls.level_id')
        ->select('collected_fees.fees_book_leaf_number', 'business_months.month_name','collected_fees.id', 'collected_fees.total_collected', 'collected_fees.collection_date','section_students.roll','sections.section_name','levels.class_name','students.name as student_name')
        ->offset($offset)
        ->limit($limit)
        ->orderBy('collected_fees.collection_date', 'desc')
        ->get();

        $filterData = $filterData->where('students.name', 'like', $search.'%')
        ->orWhere('collected_fees.collection_date', 'like', $search.'%')
        ->orWhere('collected_fees.total_collected', 'like', $search.'%')
        ->orWhere('section_students.roll', 'like', $search.'%')
        ->orWhere('sections.section_name', 'like', $search.'%')
        ->orWhere('levels.class_name', 'like', $search.'%')
        ->orWhere('collected_fees.fees_book_leaf_number', 'like', $search.'%')
        ->orWhere('business_months.month_name', 'like', $search.'%')
        ->join('students', 'students.id', '=', 'collected_fees.student_id')
        ->join('section_students', 'section_students.id', '=', 'collected_fees.section_student_id')
        ->join('sections', 'sections.id', '=', 'section_students.section_id')
        ->join('business_months', 'collected_fees.business_month_id', '=', 'business_months.id')
        ->join('level_enrolls', 'level_enrolls.id', '=', 'sections.level_enroll_id')
        ->join('levels', 'levels.id', '=', 'level_enrolls.level_id')
        ->count();
        
        return array(
            'data' => $totalData, 
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData,
        );

    }

    public function GetListForStudentDataTable($table, $limit = 20, $offset = 0, $search = [], $where = [], $join = false, $joinKey = false){

        $totalData = $this->db;
        $filterData = $this->load->database('default', true);

        if(count($where) > 0){  
            foreach ($where as $keyW => $valueW) {
                if(strpos($keyW, ' and') === false){
                    $totalData->or_where($keyW, $valueW);   
                    $filterData->or_where($keyW, $valueW);  
                }else{
                    $keyW = str_replace(' and', '', $keyW);
                    $totalData->where($keyW, $valueW);  
                    $filterData->where($keyW, $valueW);
                }

            }   
        }

        if(count($search) > 0){
            foreach ($search as $keyS => $valueS) { 
                if($keyS == 'collected_fee'){
                    $totalData->like('collected_fees.fees_book_leaf_number', $valueS, 'after');    
                    $filterData->like('collected_fees.fees_book_leaf_number', $valueS, 'after');   
                }else{
                    if(strpos($keyS, ' and') === false){
                        $totalData->or_like($keyS, $valueS, 'after');   
                        $filterData->or_like($keyS, $valueS, 'after');  
                    }else{
                        $keyS = str_replace(' and', '', $keyS);
                        $totalData->like($keyS, $valueS, 'after');  
                        $filterData->like($keyS, $valueS, 'after'); 
                    }

                }   

            }   

        }

        if($limit > 0){
            $totalData->limit($limit)->offset($offset);
        }

        $totalData->group_by($table.'.id'); 
        $filterData->group_by($table.'.id');

        $totalData->order_by($table.'.id', 'DESC'); 

        $totalData = $totalData->select($table.'.*')->get($table)->result_array();
        $filterData = $filterData->get($table)->num_rows();

        return [
           'data'           => $totalData,
           'draw'       => 0,
           'recordsTotal'   => $this->db->get($table)->num_rows(),
           'recordsFiltered'    => $filterData
       ];
   }
}

