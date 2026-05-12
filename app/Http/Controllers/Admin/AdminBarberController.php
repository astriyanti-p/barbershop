<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarberProfile;
use Illuminate\Http\Request;

class AdminBarberController extends Controller
{
    // LIST BARBERSHOP
    public function index(Request $request)
    {
    $search = $request->search;

    $barbers = BarberProfile::with('user')
                ->when($search,function($q) use ($search){
                    $q->where('shop_name','like',"%$search%");
                })
                ->latest()
                ->paginate(5);

    return view('admin.barber',compact('barbers','search'));
    }

    // DETAIL BARBERSHOP
    public function detail($id)
    {
    $barber = BarberProfile::with([
        'user',
        'services',
        'products',
        'schedules'
    ])->findOrFail($id);

    return view('admin.barber-detail',compact('barber'));
    }

   // APPROVE BARBER
    public function approve($id)
    {
    $barber = BarberProfile::findOrFail($id);
    $barber->user->update(['status'=>1]);

    return back()->with('success','Barbershop disetujui');
    }

    public function reject($id)
    {
    $barber = BarberProfile::findOrFail($id);
    $barber->user->update(['status'=>0]);

    return back()->with('success','Barbershop ditolak');
    }

    // DELETE BARBER
    public function delete($id)
    {
        BarberProfile::findOrFail($id)->delete();
        return back()->with('success','Barbershop dihapus');
    }
}
