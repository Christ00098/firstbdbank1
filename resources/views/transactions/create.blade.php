@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">New Transaction</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Transaction Type</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select type</option>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" step="0.01" name="amount" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" name="account_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">Save Transaction</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
