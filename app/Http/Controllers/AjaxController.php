<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $loc, $my_class, $user;

    public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user)
    {
        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function get_lga($state_id)
    {
//        $state_id = Qs::decodeHash($state_id);
//        return ['id' => Qs::hash($q->id), 'name' => $q->name];

        $lgas = $this->loc->getLGAs($state_id);
        return $data = $lgas->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
    }

    public function get_class_sections($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        return $sections = $sections->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
    }

    public function get_class_subjects($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        $subjects = $this->my_class->findSubjectByClass($class_id);

        if(Qs::userIsTeacher()){
            $subjects = $this->my_class->findSubjectByTeacher(Auth::user()->id)->where('my_class_id', $class_id);
        }

        $d['sections'] = $sections->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
        $d['subjects'] = $subjects->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();

        return $d;
    }

    // Modern methods for new interface
    public function getClassSections($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        $formatted_sections = $sections->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
        return response()->json($formatted_sections);
    }

    public function getLGAs($state_id)
    {
        $lgas = $this->loc->getLGAs($state_id);
        return response()->json($lgas);
    }

    public function searchParents(Request $request)
    {
        $term = $request->get('term');

        $parents = $this->user->getUserByType('parent')
            ->where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get(['id', 'name', 'email']);

        return response()->json($parents);
    }

}
