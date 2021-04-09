<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Projects;
use App\Models\ProjectHistory;
use App\Models\ProjectFiles;
use Exception;
use Auth;
use DB;
class DesignerController extends Controller
{
    public function __construct()
    {
    	//Added middleware to verify role
        $this->middleware('designer_role');
    }

    public function index()
    {
        $data = Projects::where('assign_to',Auth::user()->id)->paginate(5);
        return view('designer.projects',['data'=>$data]);
    }

    public function viewhistory($id){
        $projectdetails= ProjectHistory::where('project_id',$id)->orderBy('created_at','ASC')->get();
        foreach($projectdetails as $pk=>$pv){
            $projectdetails[$pk]->files = ProjectFiles::where('history_id',$pv->id)->get();
        }
        
        //print_r($projectdetails); exit;
        return view('designer.viewhistory',['projectdetails'=>$projectdetails,'id'=>$id]);

    }

    public function addnotes(Request $request,$id){
        try{
                //Add notes in  history table
                ProjectHistory::create(['name'=>'Designer Replied','notes'=>$request->notes,'project_id'=>$id,'created_by'=>Auth::user()->id]);
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
            return redirect()->route('designer.projects')->with("success", 'Note is added successfully');

          
        } catch (Exception $exception) {
            return redirect()->route('designer.projects')->with("failed", $exception->getMessage());
            dd($exception->getMessage());
        }


    }
    
}

