<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    // metto type e non types perche' i tipo possono avere piu' progetti ma ogni progetto ha un solo tipo
    
    // * Ora abbiamo accesso alla sintassi del tipo $post->category oppure $category->posts
    
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function getAbstract($max = 20) {
        return substr($this->description, 0 , $max) . "...";
    }
    // mutators per centralizzare caricamento immagini
    public function getImageUri()
    {
        return $this->project_preview_img ? asset('storage/' . $this->project_preview_img) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsViab5VIcW3FrUIYfgvVmuDJrbpMna6Gn742EnMJtopVO_IKFbOD496Bry2Tz4_6jfrk&usqp=CAU';
    }

    protected $fillable = ["project_preview_img",
    "name","commits",
    "contributors",
    "description","type_id"];
// ci creiamo la nostra funzione per la logica di creazione dello slug
    public static function generateSlug($name){

        $possible_slug = Str::of($name)->slug('-'); 
        // controllo che sia unico senno ciclo
        $projects = Project::where('slug',$possible_slug)->get();

        $original_slug = $possible_slug;

        $i = 2;
        // usiamo il count al posto di !empty per non finire in un loop infinito
        while (count($projects)){
            $possible_slug = $original_slug . "-" . $i;
            $projects = Project::where('slug',$possible_slug)->get();
            $i++;
        }

        return $possible_slug;

    }

    // questo tradotto sarebbe (trovami tutti i projects dove lo slug e' uguale allo slug che ho appena generato)
}