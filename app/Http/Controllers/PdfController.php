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

        $pdf = Pdf::loadView('pdf', ['data' => $data]);

        return $pdf->stream('expenses-' . $expense->id);
    }

    public function monthlyExpenses(Request $request, User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return redirect()->back();
        }

        // dd($request->query('month'));
        $date = $request->query('month');
        $data = Expense::with(['payment', 'store'])
            ->where('user_id', Auth::user()
                ->id)->where('created_at', 'LIKE', "%-{$date}-%")->latest()->get();

        // dd($data);
        $pdf = Pdf::loadView('monthly', ['data' => $data, 'email' => $user->email, 'date' => $this->parseMonth($date) ]);

        return $pdf->stream('expenses-' . $date);
    }

    private function parseMonth(string $month)
    {
        $numberMonth = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        return $numberMonth[$month];
    }
}
