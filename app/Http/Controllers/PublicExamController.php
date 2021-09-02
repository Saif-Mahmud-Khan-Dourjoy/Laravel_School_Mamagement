<?php

namespace App\Http\Controllers;

use App\PublicExam;
use App\Student;
use Illuminate\Http\Request;

class PublicExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
	{
		$this->middleware('auth');
		
		$this->middleware(function ($request, $next) {
			if(env('ROLE_ENABLE',0) == 1){                
				if (!$request->user()->hasPermission($request->route()->action['as'])){
					return redirect('warning');
				}
			}
			return $next($request);
		});
	}
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function publicExamStore($id, Request $request)
    {
        $this->validate($request, ['exam_name' => 'required',
            'year' => 'required',
        ]);
        $PublicExam= new PublicExam;
        $PublicExam->student_id = $id;
        $PublicExam->exam_name = $request->exam_name;
        $PublicExam->year = $request->year;
        $PublicExam->roll_no = $request->public_roll_no;
        $PublicExam->reg_no = $request->reg_no;
        $PublicExam->board = $request->board;
        $PublicExam->department = $request->department;
        $PublicExam->result = $request->result;
        $PublicExam->save();
        return redirect('/students/'.$id.'/edit')->with('message', 'Exam Information Added');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicExam  $publicExam
     * @return \Illuminate\Http\Response
     */
    public function show(PublicExam $publicExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicExam  $publicExam
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicExam $publicExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PublicExam  $publicExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicExam $publicExam)
    {
        $this->validate($request, ['exam_name' => 'required',
            'year' => 'required',
        ]);
        $data = [       
                'exam_name' => $request->exam_name,
                'year' => $request->year,
                'roll_no' => $request->public_roll_no,
                'reg_no' => $request->reg_no,
                'board' => $request->board,
                'department' => $request->department,
                'result' => $request->result
        ];
        $publicExam->update($data);
        return redirect('/students')->with('message', 'Public Exam Information updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicExam  $publicExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicExam $publicExam)
    {
        $publicExam->delete();
        return redirect('/students')->with('message', 'Public Exam Information Deleted');
    }
}
