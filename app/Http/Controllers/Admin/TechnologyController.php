<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
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
      $technologies = Technology::orderBy($sort, $order)->paginate(15)->withQueryString();

        return view('admin.technologies.index',compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Technology $technology)
    {
        $technology = new Technology;
        return view('admin.technologies.form',compact('technologies'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Technology $technology)
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

            $technology = new Technology;
            $technology->fill($request->all());
            $technology->save();

            return to_route('admin.technologies.show',$technology)
            ->with('message',"Technology $technology->label created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show',compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.form',compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
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

            
            $technology->update($request->all());
            

            return to_route('admin.technologies.show',$technology)
            ->with('message',"Technology $technology->label modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology_id = $technology->id;
        $technology->delete();
        return to_route('admin.technologies.index')
            ->with('message',"Technology $technology_id Deleted successfully");
    }
}