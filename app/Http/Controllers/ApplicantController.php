<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use App\Http\Requests\StoreApplicantRequest;
use App\Notifications\ApplicationSent;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $positions=Position::all();


       return view('applicant.create')->with('positions',$positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicantRequest $request)
    {
        $validated = $request->validated();

        $extension = $validated['cv']->extension();
        $filename = auth()->user()->email.'_cv.'.$extension;
        $validated['cv']->move('Files/',$filename);
        $Applicant=new Applicant();
        $Applicant->user_id=auth()->user()->id;
        $Applicant->position_id=$validated['position'];
        $Applicant->description=$validated['description'];
        $Applicant->cv=$filename;
        $Applicant->save();

        $link=url('/')."/Files/".$filename ;
        $admin=User::where('role_id',1)->first();
        if($admin!=null)
        {
            $data = array(
                'link'=>$link,
                'email' => auth()->user()->email,
            );
            $admin->notify(new ApplicationSent($data));
            
        }
        

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
