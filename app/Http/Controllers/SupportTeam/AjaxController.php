<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
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

    public function getClassSections($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        return response()->json($sections);
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
        
        return response()->json($parents->map(function($parent) {
            return [
                'id' => $parent->id,
                'text' => $parent->name . ' (' . $parent->email . ')'
            ];
        }));
    }
}
