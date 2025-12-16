@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0">Create Your Account</h4>
                    <small>Secure Virtual Banking Registration</small>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Account Number (Auto Generated) -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Account Number</label>
                            <input type="text"
                                   id="account_number"
                                   class="form-control form-control-lg @error('account_number') is-invalid @enderror"
                                   name="account_number"
                                   readonly>
                            @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Security Question -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Security Question</label>
                            <select name="security_question"
                                    class="form-select form-select-lg @error('security_question') is-invalid @enderror"
                                    required>
                                <option value="">-- Select a security question --</option>
                                <option value="Name of your childhood best friend">Name of your childhood best friend</option>
                                <option value="What is your favorite food">What is your favorite food</option>
                                <option value="What is your hobby">What is your hobby</option>
                            </select>
                            @error('security_question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Security Answer -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Security Answer</label>
                            <input type="text"
                                   class="form-control form-control-lg @error('security_answer') is-invalid @enderror"
                                   name="security_answer"
                                   value="{{ old('security_answer') }}"
                                   required>
                            @error('security_answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password"
                                   class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   name="password"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password"
                                   class="form-control form-control-lg"
                                   name="password_confirmation"
                                   required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                Register
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center bg-light">
                    <small>
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Login</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Auto-generate 10-digit Account Number -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('account_number');
    if (!input.value) {
        let num = '';
        for (let i = 0; i < 10; i++) num += Math.floor(Math.random() * 10);
        input.value = num;
    }
});
</script>
@endsection
