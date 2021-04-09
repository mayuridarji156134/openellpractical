<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Projects;
use App\Models\ProjectFiles;
use App\Models\ProjectHistory;
use Validator;
use Socialite;
use Exception;
use Auth;
use DB;
class ClientController extends Controller
{

    public function __construct()
    {
        //Added middlware to verify role
        $this->middleware('client_role');
    }

    public function index()
    {
        $data = Projects::where('created_by',Auth::user()->id)->paginate(5);
        return view('client.projects',['data'=>$data]);
    }


    public function create(){
        //get designers

        $designer=User::where('user_type','designer')->get();
        return view('client.create',['designer'=>$designer]);   
    }

    public function store(Request $request){
        try{
            $createProjects= Projects::create(['title'=>$request->title,'description'=>$request->description,'due_date'=>$request->due_date,'assign_to'=>$request->assign_to,'created_by'=>Auth::user()->id,'status'=>'assigned']);
            if($createProjects){
                $pid= DB::getPdo()->lastInsertId();

                //Add entry in  history table
                ProjectHistory::create(['name'=>'Project assigned','project_id'=>$pid,'created_by'=>Auth::user()->id]);
                $historyid= DB::getPdo()->lastInsertId();

                if($request->hasfile('files'))
                {
                    $dirpath = public_path('/images/client/projectfiles');
                    if(!is_dir($dirpath)){
                        mkdir($dirpath, 0777, true);
                    }
                    foreach($request->file('files') as $image)
                    {
                        $result_image = preg_replace('/ /','-',$image->getClientOriginalName());
                        $file = time().'_'.$result_image;
                        $image->move($dirpath, $file);

                        ProjectFiles::create([
                            'name'=>$file,
                            'project_id'=>$pid,
                            'history_id'=>$historyid,
                            'created_by'=>Auth::user()->id,
                        ]);
                    }   
                }


            }
            return redirect()->route('client.projects')->with("success", "Project created successfully");
        } catch (Exception $exception) {
            return redirect()->route('client.projects')->with("failed", $exception->getMessage());
            dd($exception->getMessage());
        }
    }
  
    public function changestatus(Request $request){
        $pid= $request['pid'];
        $update= Projects::where('id',$pid)->update(['status'=>'completed']);
        if($update){
            //Add entry in  history table
            ProjectHistory::create(['name'=>'Project is Completed','project_id'=>$pid,'created_by'=>Auth::user()->id]);
            return 'true';
        }
        else{
            return 'false';
        }
    }

    public function viewhistory($id){
        $projectdetails= ProjectHistory::where('project_id',$id)->orderBy('created_at','ASC')->get();
        foreach($projectdetails as $pk=>$pv){
            $projectdetails[$pk]->files = ProjectFiles::where('history_id',$pv->id)->get();
        }
        
        //print_r($projectdetails); exit;
        return view('client.viewhistory',['projectdetails'=>$projectdetails,'id'=>$id]);

    }

    public function addnotes(Request $request,$id){
        try{
                //Add notes in  history table
                ProjectHistory::create(['name'=>'Client Added comment','notes'=>$request->notes,'project_id'=>$id,'created_by'=>Auth::user()->id]);
                $historyid= DB::getPdo()->lastInsertId();

                if($request->hasfile('files'))
                {
                    $dirpath = public_path('/images/client/projectfiles');
                    if(!is_dir($dirpath)){
                        mkdir($dirpath, 0777, true);
                    }
                    foreach($request->file('files') as $image)
                    {
                        $result_image = preg_replace('/ /','-',$image->getClientOriginalName());
                        $file = time().'_'.$result_image;
                        $image->move($dirpath, $file);

                        ProjectFiles::create([
                            'name'=>$file,
                            'project_id'=>$id,
                            'history_id'=>$historyid,
                            'created_by'=>Auth::user()->id,
                        ]);
                    }   
                }
            return redirect()->route('client.projects')->with("success", 'Note is added successfully');

          
        } catch (Exception $exception) {
            return redirect()->route('client.projects')->with("failed", $exception->getMessage());
            dd($exception->getMessage());
        }


    }
}
