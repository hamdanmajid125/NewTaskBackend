<?php

namespace App\Http\Controllers\jobtype;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
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
        $data = new JobType();

        if($search != null){
            $query = JobType::query();

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


        return view('jobtype.job-type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('jobtype.job-type.create', compact('data'));
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
        
        $request->request->remove('_token');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/jobtype')) or File::makeDirectory(public_path('uploads/jobtype'), 0777, true, true);

            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/jobtype'), $fileName);
            $data['image'] = 'uploads/jobtype/'.$fileName;
        }
        JobType::create($data);

        return redirect('admin/jobtype/job-type')->with('success', 'JobType added!');
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
        $data = JobType::findOrFail($id);

        return view('jobtype.job-type.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, JobType $jobtype)
    {
        
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/jobtype')) or File::makeDirectory(public_path('uploads/jobtype'), 0777, true, true);
            if (File::exists(public_path($jobtype->image))) {
                File::delete(public_path($jobtype->image));
            }
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/jobtype'), $fileName);
            $data['image'] = 'uploads/jobtype/'.$fileName;
        }
        $jobtype->update($data);
        return redirect()->back()->with('success', 'JobType Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(JobType $jobtype)
    {

        $status = $jobtype->status;
        if($status == 0){
            $jobtype->status = 1;
            $message = 'Deactive';
        }else{
            $jobtype->status = 0;
            $message = 'Active';
        }
        $jobtype->save();

        return redirect()->back()->with('success', 'JobType '.$message);

    }
}
