<?php

namespace App\Http\Controllers;

use App\Models\speech;
use App\Models\User;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showWelcomePage()
    {
        //
        $users = User::all();
        return view('welcome', compact('users'));
        //return view('welcome');
    }

    public function handle1(Request $request)
    {
        //$query = $request->input('query');
        // Split on the delimiter "@@%"
        $parts = explode('@@%', $request->input('query'));
        $query = strtolower($parts[0]);
        $chi = trim($parts[1]);

        // Your logic here (API call, chatbot logic, etc.)
        if ($query == strtolower(Auth::user()->security_answer)) {
            $chi = "Yes";
        }

        if ($query == "what's my balance") {
            if ($chi == "Yes") {
                $reply = "Your balance: £" . number_format(Auth::user()->balance, 2, '.', ',');
            } else {
                $reply = Auth::user()->security_question;
            }
        } elseif ($query == "show recent transactions") {
            $reply = "Here are your recent transactions: <br/>" .
                "1. £50.00 - Grocery Store <br/>" .
                "2. £120.00 - Online Shopping <br/>" .
                "3. £30.00 - Gas Station";
        } elseif ($query == "last transaction") {
            if ($chi == "Yes") {
                $reply = "Your last transaction was £" . number_format(Auth::user()->last_transaction_amount, 2, '.', ',');
            } else {
                $reply = Auth::user()->security_question;
            }
        } elseif ($query == "branch hours") {
            $reply = "Our branch hours are Monday to Friday, 9 AM to 5 PM.";
        } elseif ($query == "my profile") {
            if ($chi == "Yes") {
                $reply = "Profile Information: <br/>" .
                    "Name: " . Auth::user()->name . "<br/>" .
                    "Account Number: " . Auth::user()->account_number . "<br/>" .
                    "Account Type: " . (Auth::user()->account_type ?? 'N/A');
            } else {
                $reply = Auth::user()->security_question;
            }
        } elseif ($query == "help") {
            $reply = "You can ask me things like: <br/>" .
                "• What's my balance? <br/>" .
                "• Show recent transactions <br/>" .
                "• Last transaction <br/>" .
                "• Branch hours <br/>" .
                "• My profile";
        } elseif ($query == "hello" || $query == "hi") {
            $reply = "Hello! " . Auth::user()->name . " How can I assist you today?";
        } elseif ($query == "thank you" || $query == "thanks") {
            $reply = "You're welcome! If you have any more questions, feel free to ask.";
        } elseif ($query == "goodbye" || $query == "bye") {
            $reply = "Goodbye! Have a great day!";
        } elseif ($query == "logout" || $query == "log out") {
            Auth::logout();
            $request->session()->invalidate();  // invalidate the session
            $request->session()->regenerateToken(); // fresh CSRF token
            $reply = "logged out successfully.";
            //return view('welcome');

        } elseif ($query == "help me" || $query == "i need help") {
            $reply = "Sure, I'm here to help! You can ask me about your account balance, recent transactions, branch hours, and more. What do you need assistance with?";
        } elseif ($query == "what can you do" || $query == "your features") {
            $reply = "I can assist you with various banking-related inquiries such as checking your balance, viewing recent transactions, providing branch hours, and accessing your profile information. Just ask!";
        } elseif ($query == "ok" || $query == "okay") {
            $reply = "Great! Let me know if there's anything else I can help you with.";
        } else {

            $reply = "I'm sorry, I didn't understand that. Please try again.";
        }
        return response()->json([
            'response' => $reply,
            'chig' => $chi
        ]);
    }

    public function matchIntent(string $input): ?string
    {
        $input = strtolower(trim($input));

        // Intent map: phrases → responses
        $intents = [

            'balance' => [
                'patterns' => [
                    "what's my balance",
                    "check my balance",
                    "account balance",
                    "how much money do i have",
                    "my balance",
                    "show my balance"
                ],
                'response' => 'balance'
            ],

            'last transaction' => [
                'patterns' => [
                    "last transaction",
                    "recent transaction",
                    "my last payment",
                    "my last payments",
                    "latest transaction",
                    "current transaction",
                    "latest transactions",
                    "current transactions"
                ],
                'response' => 'last transaction'
            ],
            'recent transactions' => [
                'patterns' => [
                "show recent transactions",
                "recent transactions",
                "transaction history",
                "show transactions"
                ],
                'response' => 'recent transactions'
            ],
            'duplicate transactions' => [
                'patterns' => [
                    "duplicate transactions",
                    "double transaction",
                    "repeated transaction",
                    "same transaction twice",
                    "charged twice",
                    "repeat that transactions",
                    "repeat the transaction",
                    "repeat that transaction"
                ],
                'response' => 'duplicate transactions'
            ],

            'branch hours' => [
                'patterns' => [
                "branch hours",
                "branch hour",
                "opening hours",
                "opening hour",
                "bank hours",
                "bank hour",
                "working days",
                "working hour"
                ],
                'response' => 'branch hours'
            ],

            'register' => [
                'patterns' => [
                "register",
                "sign up",
                "create account"
                ],
                'response' => 'register'
            ],

            'profile' => [
                'patterns' => [
                    "my profile",
                    "account details",
                    "my account information",
                    "personal details"
                ],
                'response' => 'profile'
            ],

            'goodbye' => [
                'patterns' => [
                    "ok goodbye",
                    "okay",
                    "ok",
                    "bye"
                ],
                'response' => 'goodbye'
            ],

            'logout' => [
                'patterns' => [
                    "logout",
                    "log out",
                    "sign out",
                    "exit account"
                ],
                'response' => 'logout'
            ],

            'help' => [
                'patterns' => [
                    "help",
                    "help me",
                    "what can you do",
                    "your features"
                ],
                'response' => 'help'
            ],
        ];

        // Match intent
        foreach ($intents as $intent) {
            foreach ($intent['patterns'] as $pattern) {
                if (str_contains($input, $pattern)) {
                    return $intent['response'];
                }
            }
        }

        return $input;
    }

    public static function detectIntent(string $input): string
    {
        $input = strtolower(trim($input));

        $intents = [

            'balance' => [
                "what's my balance",
                "what is my balance",
                "check my balance",
                "balance"
            ],

            'recent_transactions' => [
                "show recent transactions",
                "recent transactions",
                "transaction history",
                "show transactions"
            ],

            'last_transaction' => [
                "last transaction",
                "latest transaction",
                "my last transaction"
            ],

            'branch_hours' => [
                "branch hours",
                "opening hours",
                "bank hours"
            ],

            'register' => [
                "register",
                "sign up",
                "create account"
            ],

            'profile' => [
                "my profile",
                "account details",
                "my account"
            ],

            'duplicate_transactions' => [
                "duplicate transactions",
                "dublicate transactions", // typo handled
                "double transaction",
                "charged twice",
                "duplicate transaction"
            ],
        ];

        foreach ($intents as $intent => $patterns) {
            foreach ($patterns as $pattern) {
                if (str_contains($input, $pattern)) {
                    return $intent;
                }
            }
        }

        return $input;
    }

    public function handle(Request $request)
    {
        $rawQuery = $request->input('query', '');

        // Split query safely
        $parts = explode('@@%', $rawQuery);
        $query = strtolower(trim($parts[0]));
        $chi   = isset($parts[1]) ? trim($parts[1]) : 'No';
        $query = $this->matchIntent($query);
        //      dd($query);
        $user = Auth::user();

        // Security verification
        if (
            $chi !== 'Yes' &&
            hash_equals(
                strtolower($user->security_answer),
                $query
            )
        ) {
            $chi = 'Yes';
            $reply = "Yes alright! You are now verified. Now you can ask your question again.";
            return response()->json([
                'response' => $reply,
                'chig' => $chi
            ]);
        }

        // Helper function
        $requireAuth = function ($response) use ($chi, $user) {
            return $chi === 'Yes' ? $response : "Answer this security Question and repeat again. " . $user->security_question . "?";
        };

        switch ($query) {

            case "balance":
                $reply = $requireAuth(
                    "Your balance: £" . number_format($user->balance, 2)
                );
                break;

            case "last transaction":
                $reply = $requireAuth(
                    "Your last transaction was £" .
                        number_format($user->last_transaction_amount, 2)
                );
                break;

            case "profile":
                $reply = $requireAuth(
                    "Profile Information:
                 Name: {$user->name}
                 Account Number: {$user->account_number}
                 Account Type: " . ($user->account_type ?? 'N/A')
                );
                break;

            case "duplicate transactions":
                $reply = $requireAuth(
                    $this->duplicateTransactionsText()
                    //"To view duplicate transactions, please check your email for the detailed report."
                );
                break;

            case "recent transactions":
                $reply = "Here are your recent transactions:
                      1. £50.00 - Grocery Store
                      2. £120.00 - Online Shopping
                      3. £30.00 - Gas Station";
                break;

            case "branch hours":
                $reply = "Our branch hours are Monday to Friday, 9 AM to 5 PM.";
                break;

            case "help":
                $reply = "You can ask me:
                      • What's my balance?
                      • Show recent transactions?
                      • Last transaction?
                      • Branch hours?
                      • Register?
                      • My profile
                      • Duplicate transactions";
                break;

            case "hello":
            case "hi":
                $reply = "Hello {$user->name}! How can I assist you today?";
                break;

            case "thanks":
            case "thank you":
                $reply = "You're welcome! 😊";
                break;

            case "bye":
            case "goodbye":
                $reply = "Goodbye! Have a great day!";
                break;

            case "logout":
            case "log out":
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $reply = "Logged out successfully.";
                break;
            case "register":
                $reply = "To register, please visit our registration page and fill out the required information.";
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                //Open registration page
                return response()->json([
                    'response' => $reply,
                    'chig' => $chi,
                    'redirect' => route('register')
                ]);


            default:
                $reply = "Hello {$user->name}, Please can you ask me valid questions? I can help you with:
                      • What's my balance?
                      • Show recent transactions?
                      • Last transaction?
                      • Branch hours?
                      • Register?
                      • My profile?
                      • Duplicate transactions";
        }

        return response()->json([
            'response' => $reply,
            'chig' => $chi
        ]);
    }


    public function transcribe(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        // Save temporary file
        $path = $request->file('file')->store('speech_tmp');

        $absolutePath = Storage::path($path);

        // Send to OpenAI Whisper
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . env('OPENAI_API_KEY'),
        ])->attach(
            'file',
            file_get_contents($absolutePath),
            'audio.webm'
        )->post('https://api.openai.com/v1/audio/transcriptions', [
            'model' => 'whisper-1',
        ]);

        // Delete temp file
        Storage::delete($path);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Transcription failed',
                'details' => $response->body(),
            ], 500);
        }

        return response()->json([
            'text' => $response->json('text'),
        ]);
    }

    public function duplicateTransactionsText(): string
    {
        $userId = Auth::id();

        // Find duplicate transaction groups for this user only
        $duplicateGroups = Transaction::select(
            'trans_id',
            'amount',
            'type',
            DB::raw('COUNT(*) as total')
        )
            ->where('user_id', $userId)
            ->groupBy('trans_id', 'amount', 'type')
            ->having('total', '>', 1)
            ->get();

        // Get full records of those duplicates
        $duplicateTransactions = Transaction::where('user_id', $userId)
            ->whereIn('trans_id', $duplicateGroups->pluck('trans_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        if ($duplicateTransactions->isEmpty()) {
            return "You have no duplicate transactions.";
        }

        // Build the text output
        $text = "⚠ Duplicate Transactions Detected:\n\n";
        foreach ($duplicateTransactions as $txn) {
            $text .= "Transaction ID: {$txn->trans_id}\n";
            $text .= "Type: " . ucfirst($txn->type) . "\n";
            $text .= "Amount: £" . number_format($txn->amount, 2) . "\n";
            $text .= "Description: " . ($txn->description ?? '—') . "\n";
            $text .= "Bank: {$txn->bank_name}\n";
            $text .= "Date: {$txn->created_at->format('d M Y H:i')}\n";
            $text .= "Another One\n";
            $text .= "\n";
            $text .= "\n";
        }

        $text .= "\nInstruction: Please initiate a refund for these duplicate transactions after 24 hours.";

        return $text; // ✅ Return string only
    }



    public function duplicateTransactions11()
    {
        $userId = Auth::id();

        // Find duplicate transaction groups for this user only
        $duplicateGroups = transaction::select(
            'trans_id',
            'amount',
            'type',
            DB::raw('COUNT(*) as total')
        )
            ->where('user_id', $userId)
            ->groupBy('trans_id', 'amount', 'type')
            ->having('total', '>', 1)
            ->get();

        // Get full records of those duplicates
        $duplicateTransactions = Transaction::where('user_id', $userId)
            ->whereIn('trans_id', $duplicateGroups->pluck('trans_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.duplicates', compact('duplicateTransactions'));
    }

    public function duplicateTransactionsText111()
    {
        $userId = Auth::id();

        // Find duplicate transaction groups for this user only
        $duplicateGroups = Transaction::select(
            'trans_id',
            'amount',
            'type',
            DB::raw('COUNT(*) as total')
        )
            ->where('user_id', $userId)
            ->groupBy('trans_id', 'amount', 'type')
            ->having('total', '>', 1)
            ->get();

        // Get full records of those duplicates
        $duplicateTransactions = Transaction::where('user_id', $userId)
            ->whereIn('trans_id', $duplicateGroups->pluck('trans_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        if ($duplicateTransactions->isEmpty()) {
            return "You have no duplicate transactions.";
        }

        // Build the text output
        $text = "⚠ Duplicate Transactions Detected:\n\n";
        foreach ($duplicateTransactions as $txn) {
            $text .= "Transaction ID: {$txn->trans_id}\n";
            $text .= "Type: " . ucfirst($txn->type) . "\n";
            $text .= "Amount: £" . number_format($txn->amount, 2) . "\n";
            $text .= "Description: " . ($txn->description ?? '—') . "\n";
            $text .= "Bank: {$txn->bank_name}\n";
            $text .= "Date: {$txn->created_at->format('d M Y H:i')}\n";
            $text .= "-------------------------\n";
        }

        $text .= "\nInstruction: Please initiate a refund for these duplicate transactions after 24 hours.";

        return response($text, 200)
            ->header('Content-Type', 'text/plain');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(speech $speech)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(speech $speech)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, speech $speech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(speech $speech)
    {
        //
    }
}
