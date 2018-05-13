<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('menu_setting.mail_template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu_setting.mail_template.addMailTemplate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mail = new Mail;
        $mail->template_name = $request->template_name;
        $mail->template = $request->template;
        $result = $mail->save();

        if($result){
            return redirect()->route('mail.index')->with('status', 'Data Template E-Mail Has Been Saved');
        }else{
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mail = Mail::find($id);
        return view('menu_setting.mail_template.editMailTemplate', ['mail' => $mail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mail = Mail::findOrFail($id);
        $mail->template_name = $request->template_name;
        $mail->template = $request->template;
        $result = $mail->save();

        if($result){
            return redirect()->route('mail.index')->with('status', 'Data Template E-Mail Has Been Edited');
        }else{
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $result = Mail::destroy($id);
        
        if($result){
            return redirect()->route('mail.index')->with('status', 'Data Template E-Mail Has Been Deleted');
        }else{
            return false;
        }
    }

    public function apiMailTemplate(){
        $mail = Mail::select('id', 'template_name');

        return Datatables::of($mail)
                ->addColumn('action', function($mail){
                    return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> '.
                    '<a href="'.url("mail/$mail->id/edit").'" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.
                    '<form id="delete-form-'.$mail->id.'" method="post" action="'.route("mail.destroy",$mail->id).'" style="display: none">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                    </form>'.
                    '<a
                    onclick="
                    if(confirm(\'Are you sure, You Want to delete '.$mail->template_name.'?\'))
                        {
                            event.preventDefault();
                            document.getElementById(\'delete-form-'.$mail->id.'\').submit();
                        }else{
                            event.preventDefault();
                    }" 
                    class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })->rawColumns(['action'])->make(true);
    }
}
