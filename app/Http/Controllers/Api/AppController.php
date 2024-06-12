<?php

namespace App\Http\Controllers\Api;

use App\Models\FAQ;
use App\Models\Room;
use App\Models\Condition;
use App\Models\Equipment;
use App\Models\Structure;
use App\Models\Testimony;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index()
    {
        $cities = Structure::select('city', DB::raw('count(*) as count'))
            ->groupBy('city')
            ->limit(20)
            ->get();


        $structures = Structure::where('description', '!=', null)
            ->whereHas('images')
            ->with('images')
            ->limit(6)
            ->get();

        $partners = Structure::all();
        $testimonies = Testimony::limit(3)->get();
        $faqs = FAQ::limit(4)->get();

        return response()->json([
            'faqs' => $faqs,
            'cities' => $cities,
            'partners' => $partners,
            'structures' => $structures,
            'testimonies' => $testimonies,
        ]);
    }
    public function faqs()
    {
        $faqs = FAQ::all();

        return response()->json([
            'faqs' => $faqs
        ]);
    }

    public function search(Request $request)
    {

        $structures = Structure::whereHas('rooms', function ($query) use ($request) {
            $query->where('person', '>=', $request->guests)
                ->whereDoesntHave('reservations', function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->checkInDate)
                            ->where('end_date', '>=', $request->checkInDate);
                    })->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->checkOutDate)
                            ->where('end_date', '>=', $request->checkOutDate);
                    });
                });
        })
            ->where('city', $request->destination)
            ->with(['images', 'rooms' => function ($query) use ($request) {
                $query->where('person', '>=', $request->guests)
                    ->whereDoesntHave('reservations', function ($query) use ($request) {
                        $query->where(function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->checkInDate)
                                ->where('end_date', '>=', $request->checkInDate);
                        })->orWhere(function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->checkOutDate)
                                ->where('end_date', '>=', $request->checkOutDate);
                        });
                    })
                    ->select('structure_id', DB::raw('MIN(price) AS min_price'), DB::raw('MAX(price) AS max_price'))
                    ->groupBy('structure_id');
            }, 'evaluations' => function ($query) {
                $query->selectRaw('count(*) as count');
            }])
            ->get()->map(function ($structure) {
                $structure->rooms->min_price = $structure->rooms->min('min_price');
                $structure->rooms->max_price = $structure->rooms->max('max_price');
                return $structure;
            });

        // dd($structures);

        // $rooms = Room::where('person', '>=', $request->guests)
        //     ->with(['structure', 'equipment', 'reservations'])
        //     ->whereHas('structure', function ($query) use ($request) {
        //         $query->where('city', $request->destination);
        //     })
        //     ->get();

        $initialMarkers = [];
        // $roomsData = $rooms->map(function ($room) use (&$initialMarkers) {
        //     $structure = $room->structure;
        //     $structureImages = $structure->images()->get();
        //     $evaluationsCount = $structure->evaluations()->count();
        //     $initialMarkers[] = [
        //         'position' => [
        //             'lat' => $structure->latitude,
        //             'lng' => $structure->longitude,
        //         ],
        //         'draggable' => false
        //     ];
        //     return [
        //         'id' => $room->id,
        //         'name' => $room->name,
        //         'price' => $room->price,
        //         'structure' => [
        //             'id' => $structure->id,
        //             'name' => $structure->name,
        //             'city' => $structure->city,
        //             'images' => $structureImages,
        //             'latitude' => $structure->latitude,
        //             'longitude' => $structure->longitude,
        //             'description' => $structure->description,
        //             'evaluations_count' => $evaluationsCount,
        //         ],
        //         'equipment' => $room->equipment->pluck('name')->toArray(),
        //         'images' => $room->images->pluck('path')->toArray(),
        //     ];
        // })->toArray();

        $equipment = Equipment::all();

        return response()->json([
            'initialMarkers' => $initialMarkers,
            'structures' => $structures,
            'equipments' => $equipment,
        ]);
    }

    public function roomDetail($id)
    {
        $structure = Structure::with(['images', 'rooms', 'rooms.equipment', 'rooms.images'])->findOrFail($id);
        return response()->json([
            'structure' => $structure,
            'conditions' => Condition::all(),
            'faqs' => FAQ::limit(8)->get(),
        ]);
    }

    public function storeReservation(Request $request)
    {
        $room = Room::find($request->id);
        $structure = Structure::find($room->structure_id);

        $reservation = new Reservation();
        $reservation->structure_id = $structure->id;
        $reservation->room_id = $request->id;
        $reservation->rooms = $request->rooms;
        $reservation->person = $request->guests;
        $reservation->price = $room->price;
        $reservation->start_date = $request->checkInDate;
        $reservation->end_date = $request->checkOutDate;
        $reservation->name = $request->firstname . " " . $request->name;
        $reservation->email = $request->email;
        $reservation->contact = $request->contact;

        if ($reservation->save()) {
            return response()->json([
                'success' => 'Success'
            ]);
            
        } else {
            return response()->json([
                'success' => 'Failed'
            ]);
        }
    }

    public function getStructureRoom ($idRoom){

        $room = Room::where('id',$idRoom)->with(['structure','equipment'])->first();
        //dd($room);
        return $room;

    }
}
