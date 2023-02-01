<?php

namespace App\Http\Controllers\availability;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
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
        $data = new Availability();

        if($search != null){
            $query = Availability::query();

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


        return view('availability.availability.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('availability.availability.create', compact('data'));
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
            File::isDirectory(public_path('uploads/availability')) or File::makeDirectory(public_path('uploads/availability'), 0777, true, true);

            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/availability'), $fileName);
            $data['image'] = 'uploads/availability/'.$fileName;
        }
        Availability::create($data);

        return redirect('admin/availability/availability')->with('success', 'Availability added!');
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
        $data = Availability::findOrFail($id);

        return view('availability.availability.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Availability $availability)
    {
        
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/availability')) or File::makeDirectory(public_path('uploads/availability'), 0777, true, true);
            if (File::exists(public_path($availability->image))) {
                File::delete(public_path($availability->image));
            }
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/availability'), $fileName);
            $data['image'] = 'uploads/availability/'.$fileName;
        }
        $availability->update($data);
        return redirect()->back()->with('success', 'Availability Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Availability $availability)
    {

        $status = $availability->status;
        if($status == 0){
            $availability->status = 1;
            $message = 'Deactive';
        }else{
            $availability->status = 0;
            $message = 'Active';
        }
        $availability->save();

        return redirect()->back()->with('success', 'Availability '.$message);

    }
}
