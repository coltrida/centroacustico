<?php

namespace App\Http\Controllers;

use App\Services\AppuntamentoService;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppuntamentoController extends Controller
{
    public function appuntamenti($idClient, AppuntamentoService $appuntamentoService, ClienteService $clienteService)
    {
        $bookings = $appuntamentoService->appuntamentiByIdUser(Auth::id());
        $client = $clienteService->clientById($idClient);
        $events = [];
        foreach ($bookings as $booking){
            $color = null;
            if ($booking->tipo == 'Prima Visita'){
                $color = '#924ACE';
            }elseif ($booking->tipo == 'Consegna Apa'){
                $color = '#68B01A';
            }elseif ($booking->tipo == 'Controllo'){
                $color = '#3F399AFF';
            }

            $events[] = [
                'id' => $booking->id,
                'tipo' => $booking->tipo,
                'title' => $booking->client->fullName,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color,
            ];
        }
        return view('user.appuntamento', compact('events', 'client'));
    }

    public function aggiungi(Request $request, AppuntamentoService $appuntamentoService)
    {
        $booking = $appuntamentoService->aggiungiAppuntamento($request);

        $color = null;
        if ($booking->tipo == 'Prima Visita'){
            $color = '#924ACE';
        }elseif ($booking->tipo == 'Consegna Apa'){
            $color = '#68B01A';
        }elseif ($booking->tipo == 'Controllo'){
            $color = '#3F399AFF';
        }

        return response()->json([
            'id' => $booking->id,
            'tipo' => $booking->tipo,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->client->fullName,
            'color' => $color ?: '',
        ]);
    }

    public function modifica($id, Request $request, AppuntamentoService $appuntamentoService)
    {
        $appuntamentoService->AggiornaOrario($id, $request);
        return response()->json('Event aggiornato');
    }

    public function elimina($id, AppuntamentoService $appuntamentoService)
    {
        $appuntamentoService->eliminaAppuntamento($id);
        return $id;
    }
}
