<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\JobType;
use Auth;
use App\Models\Availability;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('isUser');
    }
  
    
   
    public function index()
    {
        $jobs_type = JobType::all();
       
        $country = DB::table('countries')->get();
        $tags = Tag::all();
        $jobs_type = JobType::all();
        $available = Availability::all();
  
        $post = Post::with(['user','country','availability','job_types','images'])->get();
     

        return view('user.dashboard', compact('jobs_type', 'country','available', 'post','tags'));
    }
    public function filter(Request $request){
        $jobs_type = JobType::all();
       
        $country = DB::table('countries')->get();
        $tags = Tag::all();
        $jobs_type = JobType::all();
        $available = Availability::all();
        $post = Post::all();
        // dd($request->input());
        if($request->input('skills')){
            $skills = $request->input('skills');
                $post = Post::whereHas('tags', function($q) use($skills) {
                    $q->whereIn('tag_id', $skills);
                })->get();
           
        }
        if($request->input('available'))
        {
            $post = $post->where('available_id', $request->input('available'));
        }
      
        if($request->input('max') && $request->input('min'))
        {
            $post = $post->where('pay', '<=', $request->input('min'))->where('pay', '>=', $request->input('max'));


         }
         if($request->input('country'))
         {
            $post = $post->where('country_id', $request->input('country'));
         }
         return view('user.dashboard', compact('jobs_type', 'country','available', 'post','tags'));
      
       
       
    }
}
