<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function stream(User $user, Expense $expense)
    {
        if (Auth::user()->id !== $user->id) {
            return redirect()->back();
        }

        $date = Carbon::parse($expense->created_at);

        $data = [
            'email' => $user->email,
            'payment' => $expense->payment->name,
            'message' => $expense->message,
            'store' => $expense->store->name,
            'amount' => $expense->amount,
            'date' => $date->format('m-d-Y'),
        ];

        // dd($data);

        $pdf = Pdf::loadView('pdf', ['data' => $data]);

        return $pdf->stream('expenses-' . $expense->id);
    }
}
