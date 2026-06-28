<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guests_count' => 'required|integer|min:1',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'guests_count' => $request->guests_count,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Votre réservation a bien été envoyée. Nous vous contacterons pour confirmation.');
    }
}
