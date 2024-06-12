<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreTestimonyRequest;
use App\Http\Requests\UpdateTestimonyRequest;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $testimonies = $structure->testimonies()->get();
        return view('app.testimony.index', [
            'testimonies' => $testimonies,
            'my_actions' => $this->testimony_actions(),
            'my_attributes' => $this->testimony_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.testimony.create', [
            'my_fields' => $this->testimony_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonyRequest $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        return view('app.testimony.edit', [
            'testimony' => $testimony,
            'my_fields' => $this->testimony_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony)
    {
        return view('app.testimony.edit', [
            'testimony' => $testimony,
            'my_fields' => $this->testimony_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonyRequest $request, Testimony $testimony)
    {
        $testimony->name = $request->name;
        $testimony->description = $request->description;

        if ($testimony->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('testimony');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        try {
            $testimony = $testimony->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('testimony');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function testimony_columns()
    {
        $columns = (object) array(
            'note' => 'Note',
            'comment' => 'Commentaire',
            'author' => 'Auteur',
            'status' => 'Status',
        );
        return $columns;
    }

    private function testimony_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function testimony_fields()
    {
        $fields = [
            'publish' => [
                'title' => 'Publier',
                'field' => 'select',
                'options' => [
                    '0' => 'Non',
                    '1' => 'Oui',
                ],
            ],
        ];

        return $fields;
    }
}
