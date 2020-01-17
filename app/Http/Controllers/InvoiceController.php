<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Project;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_contents(Request $request)
    {
        //
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:25000'
        ]);

        $path = $request->file('import_file')->getRealPath();
        if ($path){
            $rows = array_map('str_getcsv', file($path));
            

            
            if($request->input('headers')){
                $removed = array_shift($rows);
            }
            
            $projects = array();
            
            $companies = array();
            foreach($rows as $row){
                $project = new Project;
                $project->employee = $row[0];
                $project->rate = $row[1];
                $project->company = $row[2];
                $project->date = $row[3];
                $project->start = $row[4];
                $project->end = $row[5];
                $projects[] = $project;

                if(!in_array($project->company, $companies)){
                    $companies[] = $project->company;
                }
            }
        
            $data = [
                'companies' => $companies,
                'projects' => $projects,
            ];
            return view('invoices.list')->with('data', $data);
        } else {
            return back()->with('error', 'File could not be read.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        //
        //die(print_r(($request->input('projects'))));
        if($request->input('projects')){
            $data = [
                'company'=>$request->input('company'),
                'project'=> json_decode(base64_decode($request->input('projects'))),
            ];
            return view('invoices.invoice')->with('data',$data);
        }else{
            return back()->with('error', 'Invoice could not be created.');
        }
    }

}
