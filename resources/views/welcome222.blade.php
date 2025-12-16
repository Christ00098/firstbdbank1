<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bootstrap Chat U</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #e9eef5;
    }

    .chat-wrapper {
      height: 90vh;
      max-width: 700px;
      margin: auto;
      border-radius: 20px;
      overflow: hidden;
      background: #fff;
      display: flex;
      flex-direction: column;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .chat-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
    }

    .msg-bot {
      max-width: 75%;
      background: #f1f5ff;
      padding: 15px;
      border-radius: 15px;
      border-bottom-left-radius: 0;
      margin-bottom: 20px;
      color: #333;
    }

    .msg-user {
      max-width: 75%;
      background: #032e6b;
      padding: 15px;
      border-radius: 15px;
      border-bottom-right-radius: 0;
      margin-bottom: 20px;
      color: #fff;
      margin-left: auto;
    }

    .chat-footer {
      border-top: 1px solid #ddd;
      padding: 15px;
      display: flex;
      gap: 10px;
    }

    .chat-input {
      flex: 1;
      border-radius: 30px;
      padding: 10px 15px;
      border: 1px solid #ccc;
    }

    .chat-send {
      padding: 10px 20px;
      border-radius: 30px;
    }
  </style>
</head>
<body>

<div class="chat-wrapper">

  <!-- CHAT MESSAGES -->
  <div class="chat-body">

    <!-- BOT MESSAGE -->
    <div class="msg-bot">
      Your balance: £3,450.75 <br><br>
      What do you want to do today? Type or say: <br>
      • "What's my balance?" <br>
      • "Last transaction?" <br>
      • "Branch hours?" <br>
      • "My profile?"
    </div>

    <!-- USER MESSAGE -->
    <div class="msg-user">
      what's my balance
    </div>

    <!-- BOT MESSAGE -->
    <div class="msg-bot">
      Hi John Smith, your current balance for account ending in ** is £3,450.75.
    </div>

  </div>

  <!-- INPUT SECTION -->
  <div class="chat-footer">
    <input type="text" class="chat-input" placeholder="Type your message...">
    <button class="btn btn-primary chat-send">Send</button>
  </div>

</div>

</body>
</html>
