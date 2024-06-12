<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $structures = Structure::count();
        $equipment = Equipment::count();

        $structure = Auth::user()->structure;
        $rooms = $structure->rooms()->count();
        $condition = $structure->conditions()->count();
        $reservation = $structure->reservations()->count();
        $testimony = $structure->testimonies()->count();
        $faq = $structure->faqs()->count();

        return view('app.index', compact(
            'structures',
            'rooms',
            'equipment',
            'condition',
            'reservation',
            'testimony',
            'faq',
        ));
    }
}
