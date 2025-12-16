<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firstbd Banks of United Kingdom</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <style>
        /* Modern Bank of UK Styling */
        :root {
            --primary: #690c69ff;
            --secondary: #076e1dff;
            --accent: #00c4cc;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #8cb300, #023302ff);
            color: var(--dark);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header with logo */
        header {
            text-align: center;
            padding: 25px 0;
            margin-bottom: 25px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .logo {
            font-size: 2.8rem;
            background: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-weight: 700;
            font-size: 2.2rem;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            margin-top: 8px;
            font-weight: 400;
        }

        /* Feature Cards */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: rgba(0, 35, 102, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: var(--primary);
        }

        .feature-card h3 {
            color: var(--primary);
            font-size: 1.4rem;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .feature-card p {
            color: #6c757d;
            line-height: 1.6;
        }

        /* Chat interface */
        .chat-box {
            height: 400px;
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 90px;
            /* Space for fixed input bar */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 14px 20px;
            margin: 10px 0;
            border-radius: 20px;
            max-width: 85%;
            line-height: 1.5;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bot {
            background: #e9ecef;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
            color: var(--dark);
        }

        .user {
            background: var(--primary);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }

        /* Login section */
        .login-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .login-section h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .login-input {
            padding: 16px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .login-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 35, 102, 0.15);
            outline: none;
        }

        .login-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0, 35, 102, 0.3);
        }

        .login-btn:hover {
            background: #00194c;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 35, 102, 0.4);
        }

        /* Fixed Input Bar with Mic */
        .input-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px 20px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            display: none;
        }

        .input-container {
            display: flex;
            gap: 10px;
            max-width: 900px;
            margin: 0 auto;
            align-items: center;
        }

        .mic-btn-small {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--accent);
            color: var(--primary);
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 196, 204, 0.3);
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .mic-btn-small:hover {
            transform: scale(1.08);
            border-color: var(--primary);
        }

        .mic-btn-small.listening {
            background: #ff4d4d;
            border-color: #ff4d4d;
            color: white;
            animation: pulse-small 1.5s infinite;
        }

        @keyframes pulse-small {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(255, 77, 77, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 77, 77, 0);
            }
        }

        #userInput {
            flex: 1;
            padding: 14px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            min-width: 0;
        }

        #userInput:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 35, 102, 0.15);
            outline: none;
        }

        .send-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .send-btn:hover {
            background: #00194c;
            transform: scale(1.05);
        }

        /* Profile Card Styles */
        .profile-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin: 10px 0;
            border-left: 4px solid #0056b3;
            font-size: 0.95em;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            background: #0056b3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .account-number {
            color: #6c757d;
            font-size: 0.9em;
        }

        .profile-section {
            margin-bottom: 18px;
        }

        .profile-section h4 {
            color: #002366;
            margin-bottom: 8px;
            font-size: 1.1em;
        }

        .failed-items,
        .failed-items span {
            color: #dc3545 !important;
        }

        .pending-items,
        .pending-items span {
            color: #ffc107 !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .logo {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            .feature-card {
                padding: 20px;
            }

            .chat-box {
                height: 350px;
                padding: 20px;
                margin-bottom: 85px;
            }

            .login-section {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .features {
                grid-template-columns: 1fr;
            }

            .logo-container {
                flex-direction: column;
                gap: 10px;
            }

            .input-bar {
                padding: 12px 15px;
            }

            .mic-btn-small {
                width: 44px;
                height: 44px;
                font-size: 18px;
            }

            .send-btn {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }

            #userInput {
                padding: 12px 16px;
            }
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <!-- Header with enhanced logo -->
        <header>
            <div class="logo-container">
                <div class="logo">🏦</div>
                <div>
                    <h1>Firstbd Banks of United Kingdom</h1>
                    <p class="subtitle">voice interaction and chat virtual banking assistant</p>
                </div>
            </div>
        </header>

        <!-- Feature Cards -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Instant Responses</h3>
                <p>Get immediate answers to your banking questions, 24/7</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Bank-Grade Security</h3>
                <p>Your data is encrypted and protected with UK banking standards</p>
            </div>
        </div>

        <div class="chat-box" id="chatBox">
            <div class="message bot">
                👋 Welcome to <strong>Firstbd Banks of United Kingdom</strong>.<br>
                🔐 Please log in with your account number and password.
            </div>
            <div class="message bot">{{$welcomeMessage}}</div>
            <div class="message bot">{{$balance}}</div>
            <div class="message bot">{!! nl2br(e($othersText)) !!}</div>
        </div>

        <div class="login-section" id="loginSection" style="display: none;">
            <input type="text" id="accountNumber" placeholder="Account Number (e.g. 2025203011)" maxlength="10">
            <input type="password" id="password" placeholder="Password (e.g. 12345)" maxlength="5">
            <button onclick="login()">Login</button>
        </div>

        <div class="feature-card">
            <div class="voice-controls" id="voiceControls" style="display: block; text-align: center; margin: 15px 0px;">
                <button id="micBtn" class="mic-btn" onclick="toggleVoice()">
                    🎙️ Start Speaking
                </button>
                <div id="status" class="status">🔐 Logged in...</div>
            </div>

            <input type="hidden" id="Chi" value="No">


            <div class="input-area" id="inputArea" style="display: flex;">
                <input type="text" id="userInput" placeholder="Or type your query...">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>

        <script src="voice-chat.js"></script>

    </div>
</body>

</html>