<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Payment;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Expenses/Create', [
            'payments' => Payment::all(),
            'stores' => Store::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => ['required', 'not_in:Payment'],
            'store_id' => ['required', 'not_in:Store'],
            'message' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
        ]);

        // dd($request->all());
        $request->user()->expenses()->create($validated);

        return redirect(route('dashboard'));
    }


    /**
     * Display the resources filtered by specific date.
     */
    public function filter_date(Request $request)
    {
        $today = $request->today;
        return Inertia::render('Dashboard', [
            'expenses' => Expense::with(['payment', 'store'])->where('user_id', Auth::user()->id)->where('created_at', 'LIKE', "%{$today}%")->latest()->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
