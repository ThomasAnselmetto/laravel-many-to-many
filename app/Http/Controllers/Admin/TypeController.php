<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';
      $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'DESC';
      $types = Type::orderBy($sort, $order)->paginate(5)->withQueryString();

        $types = Type::all();
        return view('admin.types.index', compact('types','sort','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $type = new Type;
        return view('admin.types.form',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Type $type)
    {
        $request->validate([
            'label' => 'required|string|max:20',
            'color' => 'required|string|size:7'


        ],
        [
            'label.required' => 'Label is Required',
            'label.string' => 'Label must be a string',
            'label.max' => 'The Label must contain a maximum of 100 chars',
            'color.required' => 'Label is Required',
            'color.string' => 'Color must be a string',
            'color.size' => 'Color must contain exactly 7 chars (es. #ffffff)'

        ]);

            $type = new Type;
            $type->fill($request->all());
            $type->save();

            return to_route('admin.types.show',$type)
            ->with('message',"Type $type->label created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show',compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.form',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'label' => 'required|string|max:20',
            'color' => 'required|string|size:7'


        ],
        [
            'label.required' => 'Label is Required',
            'label.string' => 'Label must be a string',
            'label.max' => 'The Label must contain a maximum of 100 chars',
            'color.required' => 'Label is Required',
            'color.string' => 'Color must be a string',
            'color.size' => 'Color must contain exactly 7 chars (es. #ffffff)'

        ]);

            
            $type->update($request->all());
            

            return to_route('admin.types.show',$type)
            ->with('message',"Type $type->label modified successfully");
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {   
        $type_id = $type->id;
        $type->delete();
        return to_route('admin.types.index')
            ->with('message',"Type $type_id Deleted successfully");
    }
}