<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barbershop;
use App\Models\Withdraw;


class FinanceController extends Controller
{
    public function index()
{
    $barbershops = Barbershop::all();

    $totalSaldo = $barbershops->sum('saldo');
    $totalIncome = $barbershops->sum('income');
    $totalPending = $barbershops->sum('pending_withdraw');
    $totalDone = $barbershops->sum('withdraw');

    return view('admin.finance', compact(
        'barbershops',
        'totalSaldo',
        'totalIncome',
        'totalPending',
        'totalDone'
    ));
}

    public function detail($id)
    {
        $barbershop = Barbershop::findOrFail($id);

        return response()->json([
            'saldo' => $barbershop->saldo,
            'income' => $barbershop->income,
            'withdraw' => $barbershop->withdraw,
            'pending' => $barbershop->pending_withdraw,
            'withdraws' => Withdraw::where('barbershop_id', $id)->get()
        ]);
    }

    public function approve(Request $request, $id)
    {
        // logic approve
    }
}