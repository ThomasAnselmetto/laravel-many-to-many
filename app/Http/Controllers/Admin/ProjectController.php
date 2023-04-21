<?php

namespace App\Http\Controllers\Admin;

// dopo aver spostato il controller dei progetti in admin(perche' e' qua che si gestiscono le crud) aggiungo admin al namespace e aggiungo lo use della rotta use App\Http\Controllers\Controller perche' dopo lo spostamento non era piu' leggibile class ProjectController extends Controller

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Models\Project;
use App\Models\Type;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            
      //    dammi i post,se c'e' l'ordinamento dammeli in un modo,alrtrimenti in un altro

      // noi leggiamo sort e order dalla richiesta e gli diamo un default nel caso non ci sia niente e poi li usiamo nell'orderBy dopo li riportiamo anche alla view per generare i link,ruotare le freccette ecc tutto questo e' possibile grazie a withQueryString che ci mantiene la selezione anche al cambio di pagina
      
      $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';
      $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'DESC';
      $projects = Project::orderBy($sort, $order)->paginate(15)->withQueryString();
      return view('admin.projects.index',compact('projects','sort','order'));


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $project = new Project;
        $types = Type::orderBy('label')->get();
        return view('admin.projects.form', compact('project','types'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    //    il validate ha due argomenti che sono gli array 1(validazioni da fare)2(i messaggi d'errore)
       { 
        $request->validate([
            'project_preview_img'=>'nullable|image|mimes:jpg,png,jpeg',
            'name'=>'required|string|max:100',
            'contributors'=>'required|integer',
            'description'=>'required|string',
            'type_id'=>'nullable|exists:types,id'

        ],
        [
            'project_preview_img.image'=> 'You need to enter an image',
            'project_preview_img.mimes'=> 'You need to enter jpg,png or jpeg file',
            'name.required'=> 'Name is Required',
            'name.string'=> 'Name must be a string',
            'name.max'=> 'The name must contain a maximum of 100 chars',
            'contributors.required'=> 'Contributors are Required',
            'contributors.integer'=> 'Contributors must be a number',
            'description.required'=> 'Description is Required',
            'description.string'=> 'Description must be a text',
            'type_id.exists'=>'Type is invalid'

        ]);
        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'project_preview_img')) {
            if($project->project_preview_img) Storage::delete($project->project_preview_img);
            $path = Storage::put('uploads/projects', $data['project_preview_img']);
            //$data['image'] = $path;
        }

        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateSlug($project->name);
        $project->project_preview_img = $path;
        $project->save();


        // lo rimando alla vista show e gli invio sottoforma di parametro il progetto appena creato 
        return to_route('admin.projects.show',$project)
        ->with('message','Project created successfully');
        // ->with('status', 'Profile updated!');;
      }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // ritorniamo semplicemente la view della show e usiamo il compact per inviare array e le sue value
       return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('label')->get();
        return view('admin.projects.form', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $project->update($request->all());differenza tra update e fill che update riempie e salva insieme quindi se devo fare operazione nel mezzo faccio fill e save
        $request->validate([
            'project_preview_img'=>'nullable|image|mimes:jpg,png,jpeg',
            'name'=>'required|string|max:100',
            'contributors'=>'required|integer',
            'description'=>'required|string',
            'type_id'=>'nullable|exists:types,id'

        ],
        [
            'project_preview_img.image'=> 'You need to enter an image',
            'project_preview_img.mimes'=> 'You need to enter jpg,png or jpeg file',
            'name.required'=> 'Name is Required',
            'name.string'=> 'Name must be a string',
            'name.max'=> 'The name must contain a maximum of 100 chars',
            'contributors.required'=> 'Contributors are Required',
            'contributors.integer'=> 'Contributors must be a number',
            'description.required'=> 'Description is Required',
            'description.string'=> 'Description must be a text',
            'type_id.exists'=>'Type is invalid'

        ]);
        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'project_preview_img')) {
            if($project->project_preview_img) Storage::delete($project->project_preview_img);
            $path = Storage::put('uploads/projects', $data['project_preview_img']);
            //$data['image'] = $path;
        }

        $project->fill($data);
        $project->slug = Project::generateSlug($project->name);
        $project->project_preview_img = $path;
        $project->save();
        return to_route('admin.projects.show', $project)->with('message',"Project $project->name Modified successfully");
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {   
        $name_project = $project->name;
        $project->delete();
        return to_route('admin.projects.index')->with('message',"Project $name_project in trash-bin");
    }

     /**
     * Display a listing of the trashed resource.
     * 
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function trash(Request $request){
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';
           $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'DESC';
           $projects = Project::onlyTrashed()->orderBy($sort, $order)->paginate(7)->withQueryString();
        return view('admin.projects.trash',compact('projects','sort','order'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Int $id){
        
       $project = Project::where('id',$id)->onlyTrashed()->first();
        $project->forceDelete();
        return to_route('admin.projects.trash')->with('message',"Project $id Delete successfully");
    }
    /**
     * restore the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function restore(Int $id){

        $project = Project::where('id',$id)->onlyTrashed()->first();
         $project->restore();
         return to_route('admin.projects.index')->with('message',"Project $id Restored");
    }
        
}