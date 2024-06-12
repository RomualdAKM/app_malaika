<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $equipments = $structure->equipment()->get();
        return view('app.equipment.index', [
            'equipments' => $equipments,
            'my_actions' => $this->equipment_actions(),
            'my_attributes' => $this->equipment_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.equipment.create', [
            'my_fields' => $this->equipment_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request)
    {
        $equipment = new Equipment();

        $equipment->structure_id = Auth::user()->structure_id;
        $equipment->name = $request->name;
        $equipment->description = $request->description;

        if ($equipment->save()) {
            Alert::toast("Données enregistrées", 'success');
            return redirect('equipment');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        return view('app.equipment.edit', [
            'equipment' => $equipment,
            'my_fields' => $this->equipment_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->name = $request->name;
        $equipment->description = $request->description;
       
        if ($equipment->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('equipment');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        try {
            $equipment = $equipment->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('equipment');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function equipment_columns()
    {
        $columns = (object) array(
            'name' => 'Nom',
            'description' => 'Description',
        );
        return $columns;
    }

    private function equipment_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function equipment_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'description' => [
                'title' => 'Description(Facultatif)',
                'field' => 'textarea'
            ],
        ];

        return $fields;
    }
}
