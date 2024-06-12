<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\UpdateConditionRequest;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $conditions = $structure->conditions()->get();
        return view('app.condition.index', [
            'conditions' => $conditions,
            'my_actions' => $this->condition_actions(),
            'my_attributes' => $this->condition_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.condition.create', [
            'my_fields' => $this->condition_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConditionRequest $request)
    {
        $condition = new Condition();

        $condition->structure_id = Auth::user()->structure_id;
        $condition->title = $request->title;
        $condition->content = $request->content;

        if ($condition->save()) {
            Alert::toast("Données enregistrées", 'success');
            return redirect('condition');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $conditions)
    {
        return view('app.condition.show', [
            'condition' => $conditions,
            'my_fields' => $this->condition_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condition $condition)
    {
        return view('app.condition.edit', [
            'condition' => $condition,
            'my_fields' => $this->condition_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConditionRequest $request, Condition $condition)
    {
        $condition->title = $request->title;
        $condition->content = $request->content;
       
        if ($condition->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('condition');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condition $condition)
    {
        try {
            $condition = $condition->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('condition');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function condition_columns()
    {
        $columns = (object) array(
            'title' => 'Titre',
            'content' => 'Contenu',
        );
        return $columns;
    }

    private function condition_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function condition_fields()
    {
        $fields = [
            'title' => [
                'title' => 'Titre',
                'field' => 'text'
            ],
            'content' => [
                'title' => 'Contenu',
                'field' => 'textarea'
            ],
        ];

        return $fields;
    }
}
