<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\ReservationStatusEnum;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $reservations = $structure->reservations()->get();
        return view('app.reservation.index', [
            'reservations' => $reservations,
            'my_attributes' => $this->reservation_columns(),
            'my_actions' => $this->reservation_actions(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('app.reservation.show', [
            'reservation' => $reservation,
            'my_fields' => $this->reservation_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('app.reservation.edit', [
            'reservation' => $reservation,
            'my_fields' => $this->reservation_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->status = $request->status;
       
        if ($reservation->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('reservation');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        
    }

    private function reservation_columns()
    {
        $columns = (object) array(
            'start_date' => 'Début de séjour',
            'end_date' => 'Fin de séjour',
            'name' => 'Nom',
            'email' => 'Email',
            'contact' => 'Contact',
            'status_label' => 'Statut',
        );
        return $columns;
    }

    private function reservation_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
        );
        return $actions;
    }

    private function reservation_fields()
    {
        $status = [
            ReservationStatusEnum::PENDING['value'] => ReservationStatusEnum::PENDING['label'],
            ReservationStatusEnum::CONFIRMED['value'] => ReservationStatusEnum::CONFIRMED['label'],
            ReservationStatusEnum::CANCELED['value'] => ReservationStatusEnum::CANCELED['label'],
            ReservationStatusEnum::REJECTED['value'] => ReservationStatusEnum::REJECTED['label'],
            ReservationStatusEnum::FINISHED['value'] => ReservationStatusEnum::FINISHED['label'],
        ];

        $fields = [
            'status' => [
                'title' => 'Statut',
                'field' => 'select',
                'options' => $status
            ],
        ];

        return $fields;
    }
}
