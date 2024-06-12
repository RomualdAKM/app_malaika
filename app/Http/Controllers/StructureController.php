<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use App\Models\GalleryHotel;
use Illuminate\Http\Request;
use App\Mail\NewStructureMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.structure.index', [
            'structures' => Structure::all(),
            'my_actions' => $this->structure_actions(),
            'my_attributes' => $this->structure_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.structure.create', [
            'my_fields' => $this->structure_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStructureRequest $request)
    {
        $structure = new Structure();

        $fileName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('logos'), $fileName);
        $path = $fileName;

        $structure->name = $request->name;
        $structure->contact = $request->contact;
        $structure->email = $request->email;
        $structure->city = $request->city;
        $structure->address = $request->address;
        $structure->slug = $request->slug;
        $structure->logo = $path;

        if ($structure->save()) {
            Alert::toast("Données enregistrées", 'success');
            Mail::to($request->email)->send(new NewStructureMail($structure->name));
            return redirect('structure');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $structure)
    {
        return view('app.structure.edit', [
            'structure' => $structure,
            'my_fields' => $this->structure_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $structure = Structure::find($structure->id);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('logos'), $fileName);
            $path = $fileName;
        }

        $structure->name = $request->name;
        $structure->email = $request->email;
        $structure->contact = $request->contact;
        $structure->city = $request->city;
        $structure->address = $request->address;
        $structure->slug = $request->slug;
        $structure->description = $request->description;
        $structure->latitude = $request->latitude;
        $structure->longitude = $request->longitude;

        if (isset($path)) {
            $structure->logo = $path;
        }

        if ($structure->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            if (Auth::user()->role == 'superadmin') {
                return redirect('structure');
            } else {
                return redirect()->back();
            }
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $structure)
    {
        try {
            $structure = $structure->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('structure');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    public function addImage(Request $request)
    {
        $i = 0;
        foreach ($request->photo as $photo) {
            $photoHotel = new GalleryHotel();
            $fileName = time() . ++$i . '.' . $photo->extension();
            $photo->move(public_path('photos'), $fileName);
            $photoHotel->structure_id = $request->structure;
            $photoHotel->path = $fileName;
            $photoHotel->save();
        }
        return redirect()->back();
    }

    public function destroyImage($gallery)
    {
        $gallery = GalleryHotel::find($gallery);
        try {
            $gallery = $gallery->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function structure_columns()
    {
        $columns = (object) array(
            'logo' => '',
            'name' => 'Nom',
            'email' => "Email",
            'contact' => "Contact",
            'address' => "Adresse",
            "formated_date" => "Date de Creation",
        );
        return $columns;
    }

    private function structure_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function structure_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Dénomination',
                'field' => 'text'
            ],
            'contact' => [
                'title' => 'Contact',
                'field' => 'tel'
            ],
            'email' => [
                'title' => 'Email',
                'field' => 'email'
            ],
            'city' => [
                'title' => 'Ville',
                'field' => 'text'
            ],
            'address' => [
                'title' => 'Adresse',
                'field' => 'text'
            ],
            'slug' => [
                'title' => 'Lien',
                'field' => 'url'
            ],
            'logo' => [
                'title' => 'Logo',
                'field' => 'file'
            ],
        ];

        return $fields;
    }
}
