<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:credit,debit',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'trans_id' => strtoupper(Str::random(12)),
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Transaction recorded successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
