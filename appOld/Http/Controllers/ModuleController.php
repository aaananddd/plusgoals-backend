<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;
use App\Models\Module;
use App\Models\User;
use Session;

class ModuleController extends Controller
{

    public function GetTopics(){

        $result = Topic::select('id','topic')->get();

        if($result != null){
            return view('add_new_module', ['topic' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
        }
    }

    public function AddModule(Request $request){
        $user = Session::get('user');
        $user_id = $user->id;
        $module_name = $request->module_name;
        $topic_id = $request->topic;

        $result = Module::insert([
            'module_name' => $module_name,
            'topic_id' => $topic_id,
            'created_by' => $user_id,
            'is_active' => 1,
            'created_at' => date('Y-m-d')
        ]);

        if($result = true){
            return redirect()->route('listModules');
            return response()->json(['status'=>true, 'message'=>"Module created successfully"], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to create module"], 422);
        }
    }

    public function UpdateModule(Request $request, $module_id){

        $moduleDetails = Module::select('*')->where('id', $module_id)->first();

        $module_name = $request->module_name ? $request->module_name : $moduleDetails->module_name;
        $topic_id = $request->topic_id ? $request->topic_id : $moduleDetails->topic_id;
        $parent_id = $request->parent_id ? $request->parent_id : $moduleDetails->parent_id;

        $result = Module::where('id', $module_id)->update([
            'module_name' => $module_name,
            'topic_id' => $topic_id,
            'parent_id' => $parent_id
        ]);

        if($result = true){
            return redirect()->route('listModules');
            return response()->json(['status'=>true, 'message'=>"Module updated successfully"], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to create module"], 422);
        }
    }

    public function ListModules(Request $request){

        $result = Module::leftjoin('users', 'users.id','=','modules.created_by')
                        ->leftjoin('topics','topics.id','=','modules.topic_id')
                        ->select('modules.id', 'modules.module_name','modules.created_by','topics.topic', 'users.first_name', 'users.last_name')
                        ->where('modules.is_active', 1)->get();

        if($result != null){
            return view('modules_list', ['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
        }
    }

    public function RemoveModule($module_id){

        $user = Session::get('user');
        $user_id = $user->id;
        if(Module::where('id', $module_id)->exists()){

            $moduleDetails = Module::select('created_by')->where('id', $module_id)->first();

            $role = User::select('role')->where('id', $moduleDetails->created_by)->first();

            if($role->role == 1){
                $result = Module::where('id', $module_id)->update([
                    'is_active' => 0
                ]);
    
                if($result = true){
                    return redirect()->route('listModules');
                    return response()->json(['status'=>true, 'message'=>"Deactivated module"], 200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to deactivate"], 422);
                }
            } elseif ($user_id == $moduleDetails->created_by){
                $result = Module::where('id', $module_id)->update([
                    'is_active' => 0
                ]);
    
                if($result = true){
                    return redirect()->route('listModules');
                    return response()->json(['status'=>true, 'message'=>"Deactivated module"], 200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to deactivate"], 422);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"Only authorized persons are allowed to perform this action"], 401);
            }
           
        }
    }

    public function ShowModules(Request $request, $module_id){

        $result = Module::leftjoin('users', 'users.id','=','modules.created_by')
                        ->leftjoin('topics','topics.id','=','modules.topic_id')
                        ->select('modules.id', 'modules.module_name','modules.created_by','topics.topic')
                        ->where(['modules.id'=>$module_id, 'modules.is_active'=> 1])->get();
        
        $topic = Topic::select('id as topic_id', 'topic as topic_name')->get();
        $module = Module::select('id', 'module_name')->where('is_active', 1)->get();

        if($result != null){
            return view('update_modules', ['module' => $result, 'topic' => $topic, 'moduleList' => $module]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
        }
    }

    //View Modules
    public function GetModulesById($module_id)
    {
        if (Module::where('id', $module_id)->exists()) {
      
            $result = Module::leftJoin('topics', 'topics.id', '=', 'modules.topic_id')
                            ->leftJoin('users', 'users.id', '=', 'modules.created_by')
                            ->select('modules.id', 'modules.module_name', 'topics.topic', 'users.first_name', 'users.last_name')
                            ->where(['modules.id' => $module_id, 'modules.is_active' => 1])
                            ->get();
   
            $parents = [];
  
            $fetchParents = function ($moduleId) use (&$fetchParents) {
                $parent = Module::select('parent_id')->where('id', $moduleId)->first();
    
                if ($parent && $parent->parent_id !== null) {
                    $parentModule = Module::select('id', 'module_name')->where('id', $parent->parent_id)->first();
                    if ($parentModule) {
                        return array_merge([$parentModule], $fetchParents($parent->parent_id));
                    }
                }
                return [];
            };
    
            $parents = $fetchParents($module_id);
  
            $result[0]['parent'] = $parents;

            if (!empty($result)) {
                return view('module_view', ['data' => $result]);
                return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result], 200);
            } else {
                return view('module_view', ['data' => $result]);
                return response()->json(['status' => false, 'message' => "Failed to retrieve data"], 400);
            }
        } else {
       
            return response()->json(['status' => false, 'message' => "No such module exists"], 404);
        }
    }
    
    
}
