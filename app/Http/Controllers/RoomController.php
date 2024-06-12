<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Equipment;
use App\Models\GalleryRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.room.index', [
            'rooms' => Room::where('structure_id',Auth::user()->structure_id)->get(),
            'my_actions' => $this->room_actions(),
            'my_attributes' => $this->room_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.room.create', [
            'my_fields' => $this->room_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = new Room();

        $room->structure_id = Auth::user()->structure_id;
        $room->name = $request->name;
        $room->area = $request->area;
        $room->person = $request->person;
        $room->price = $request->price;
        $room->number = $request->number;

        if ($room->save()) {
            $i = 0;
            foreach ($request->photo as $photo) {
                $photoRoom = new GalleryRoom();
                $fileName = time() . ++$i . '.' . $photo->extension();
                $photo->move(public_path('photos'), $fileName);
                $photoRoom->room_id = $room->id;
                $photoRoom->path = $fileName;
                $photoRoom->save();
            }

            foreach ($request->equipment as $value) {
                $equipment = Equipment::find($value);
                $room->equipment()->attach($equipment->id);
            }

            Alert::toast("Données enregistrées", 'success');
            return redirect('room');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('app.room.show', [
            'room' => $room,
            'my_fields' => $this->room_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $photos = GalleryRoom::where('room_id', $room->id)->get();
        return view('app.room.edit', [
            'room' => $room,
            'photos' => $photos,
            'my_fields' => $this->room_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->name = $request->name;
        $room->area = $request->area;
        $room->person = $request->person;
        $room->price = $request->price;
        $room->number = $request->number;

        if ($room->save()) {
            // Supprime tous les équipements de la chambre
            $room->equipment()->detach();

            foreach ($request->equipment as $value) {
                $equipment = Equipment::find($value);
                $room->equipment()->attach($equipment->id);
            }

            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('room');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $equipments = $room->equipment()->get();
            foreach ($equipments as $equipment) {
                $room->equipment()->detach($equipment->id);
            }
            $room = $room->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('room');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    public function addImage(Request $request)
    {
        $i = 0;
        foreach ($request->photo as $photo) {
            $photoRoom = new GalleryRoom();
            $fileName = time() . ++$i . '.' . $photo->extension();
            $photo->move(public_path('photos'), $fileName);
            $photoRoom->room_id = $request->room;
            $photoRoom->path = $fileName;
            $photoRoom->save();
        }
        return redirect()->back();
    }

    public function destroyImage($gallery)
    {
        $gallery = GalleryRoom::find($gallery);
        try {
            $gallery = $gallery->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function room_columns()
    {
        $columns = (object) array(
            'name' => 'Nom',
            'area' => 'Superficie (m²)',
            'person' => 'Nombre de personne',
            'price' => 'Prix (XOF)',
            'number' => 'Nombre disponible',
        );
        return $columns;
    }

    private function room_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function room_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'area' => [
                'title' => 'Superficie (m²)',
                'field' => 'number'
            ],
            'person' => [
                'title' => 'Nombre de personnes',
                'field' => 'number'
            ],
            'price' => [
                'title' => 'Prix',
                'field' => 'number'
            ],
            'number' => [
                'title' => 'Nombre disponible',
                'field' => 'number'
            ],
            'equipment' => [
                'title' => 'Equipements/Services',
                'field' => 'checkbox',
                'options' => Equipment::all()
            ],
        ];

        if (Route::currentRouteName() == 'room.create') {
            $fields['photo'] = [
                'title' => 'Photos',
                'field' => 'multiple-file'
            ];
        }

        return $fields;
    }
}
