<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use App\Events\UserRegister;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
    	return Socialite::driver($provider)->redirect();
    	//Redirect to Facebook
    }

    public function handleProviderCallback($provider)
    {
        try {
			    
            $user = Socialite::driver($provider)->stateless()->user();
          	$socialId = User::where('social_id', $user->id)->first();
            if($socialId){
				Auth::login($socialId);
				if($socialId->user_type=='client'){
			        return redirect('/client/projects');
		        }
		        elseif($socialId->user_type=='designer'){
			        return redirect('/designer/projects');
		        }
		        else{
		        	return redirect('/dashboard');	
		        }
            }else{
            	//Check for mail while registering
            	$emailexist= User::where('email', $user->email)->first();
		        if(empty($emailexist))	{
		        	$createUser = User::create([
		                'name' => $user->name,
		                'email' => $user->email,
		                'social_id' => $user->id,
		              	'password' => \Hash::make('john123')
		            ]);
		            // print_r($user->id); exit;
					\Session::put('social_id',$user->id);
		        	return redirect()->route('user.signup');
		        }
		        else{
		        	return redirect()->back();
		        }
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function completeSignup(){
    	$social_id= \Session::get('social_id');
    	$user = User::where('social_id', $social_id)->first();
        //print_r($user); exit;
        return view('auth.completeSignup',['user'=>$user]);
    }

    public function SignupStore(Request $request){
	 	try {
	 		$image = "";
	 		$social_id= \Session::get('social_id');
	        $dirpath = public_path('/images/userprofile');
	        if (!empty($request->file('profile')))
	        {
	            $extention = $request->file('profile')->getClientOriginalExtension();
	            if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif') 
	            {
	                // Image name
	                $requestImage = $request->file('profile');
	                $result_image = preg_replace('/ /','-',$requestImage->getClientOriginalName());
	                $image = time().'_'.$result_image;
	                // Create folder if not and give 777 permission
	                if(!is_dir($dirpath)){
	                    mkdir($dirpath, 0777, true);
	                }
	                $request->file('profile')->move($dirpath, $image);
	            } else {
	                $flashArr = array(
	                    'msg' => 'Please upload Image having extension jpg|jpeg|png|svg|gif. '
	                );
	                $request->session()->flash('err_message', $flashArr);
	                return redirect()->route('admin.questionnaire1.index')->withInput()->with('err_message', $flashArr);
	            }
	        }

	        User::where('social_id', $social_id)->update(['profile'=>$image,'dialcode_phoneno'=>$request->dialcode_phoneno,'user_type'=>$request->user_type]);

	        $user=User::where('social_id', $social_id)->first();
	        //calll event for registration
			event(new UserRegister($user));						  
	        Auth::login($user);
	       	if($user->user_type=='client'){
		        return redirect('/client/projects');
	        }
	        elseif($user->user_type=='designer'){
		        return redirect('/designer/projects');
	        }
	        else{
	        	return redirect('/dashboard');	
	        }
	    } catch (Exception $exception) {
	        dd($exception->getMessage());
	    }
    }

    public function checkphoneunique(Request $request)
    {
    	$data= User::where('dialcode_phoneno',$request['dialcode_phoneno'])->first();
    	if($data){
    		return 'false';
    	}
    	else{
    		return 'true';	
    	}
    }
}


 