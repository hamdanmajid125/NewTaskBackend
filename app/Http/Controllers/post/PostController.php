<?php

namespace App\Http\Controllers\post;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use File;
use App\Models\PostImage;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

     public function removeColumns($columns, $columsToBeRemove)
    {
        foreach ($columsToBeRemove as $value) {
            if (($key = array_search($value, $columns)) !== false) {
                unset($columns[$key]);
            }
        }
        return $columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = new Post();

        if($search != null){
            $query = Post::query();

            $table = $data->getTable();

            $columns = $this->removeColumns(Schema::getColumnListing($table), ['created_at', 'updated_at', 'image', 'id']);

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }
            $data = $query->orderBy('name')->paginate(12);

            if($request->onChange == true)
            {
                return response()->json(['status' => true, 'data' => $data,'lastPage' => $data->lastPage()]);
            }

        }
        else{
            $data = $data->paginate(12);
            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        }


        return view('post.post.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('post.post.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'description' => 'required',
            'pay'=>'required'
		]);
        $post = new Post;
        $post->name = $request->input('name');
        $post->available_id = $request->input('available');
        $post->type = $request->input('type');
        $post->country_id = $request->input('country');
        $post->pay = $request->input('pay');
        $post->description = $request->input('description');
        $post->status = 1;
        $post->user_id = Auth::user()->id;
        $post->save();
        $post->tags()->attach($request->input('tags'));

        if ($request->hasFile('images')) {
            File::isDirectory(public_path('uploads/post')) or File::makeDirectory(public_path('uploads/post'), 0777, true, true);
            foreach ($request->file('images') as $key => $value) {
                $fileName = time().'.'.$value->extension();
                $value->move(public_path('uploads/post'), $fileName);
                $post_image = new PostImage;
                $post_image->image = 'uploads/post/'.$fileName;
                $post_image->post_id = $post->id;
                $post_image->save();
            }



        }


        return redirect()->back()->with('success', 'Post added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Post::findOrFail($id);

        return view('post.post.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
			'name' => 'required',
			'description' => 'required',
			'image' => 'required'
		]);
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/post')) or File::makeDirectory(public_path('uploads/post'), 0777, true, true);
            if (File::exists(public_path($post->image))) {
                File::delete(public_path($post->image));
            }
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/post'), $fileName);

            $data['image'] = 'uploads/post/'.$fileName;
        }
        $post->update($data);
        return redirect()->back()->with('success', 'Post Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {

        $status = $post->status;
        if($status == 0){
            $post->status = 1;
            $message = 'Deactive';
        }else{
            $post->status = 0;
            $message = 'Active';
        }
        $post->save();

        return redirect()->back()->with('success', 'Post '.$message);

    }
   
}
