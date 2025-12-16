<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Speech to Text & Text to Speech</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    #result {
      margin-top: 20px;
      padding: 15px;
      border: 1px solid #ccc;
      min-height: 150px;
      background: #f8f8f8;
      white-space: pre-wrap;
    }
    textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      margin-top: 20px;
      font-size: 16px;
    }
    button {
      padding: 10px 20px;
      font-size: 18px;
      margin-right: 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<h2>🎤 Speech to Text</h2>
<button id="start">Start</button>
<button id="stop" disabled>Stop</button>

<div id="result"></div>

<h2 style="margin-top:30px;">🗣 Text to Speech</h2>
<textarea id="ttsText" placeholder="Type text here..."></textarea>
<button id="speak">🔊 Speak</button>
<button id="stopSpeak">🛑 Stop Speech</button>

<script>
  /* ------------------------------
      SPEECH TO TEXT SECTION
  -------------------------------*/
  
  const startBtn = document.getElementById('start');
  const stopBtn  = document.getElementById('stop');
  const out      = document.getElementById('result');

  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

  if (!SpeechRecognition) {
    out.textContent = "❌ Speech recognition not supported in this browser.";
    startBtn.disabled = true;
    stopBtn.disabled = true;
  } else {
    const rec = new SpeechRecognition();
    rec.continuous = true;
    rec.interimResults = true;

    let finalTranscript = "";

    rec.onresult = event => {
      let interim = "";
      for (let i = 0; i < event.results.length; i++) {
        const transcript = event.results[i][0].transcript;
        if (event.results[i].isFinal) {
          finalTranscript += transcript + " ";
        } else {
          interim += transcript;
        }
      }
      out.innerHTML = finalTranscript + "<em style='color:#777'>" + interim + "</em>";
      out.scrollTop = out.scrollHeight;
    };

    startBtn.onclick = () => {
      rec.start();
      startBtn.disabled = true;
      stopBtn.disabled = false;
    };

    stopBtn.onclick = () => {
      rec.stop();
      startBtn.disabled = false;
      stopBtn.disabled = true;
    };
  }

  /* ------------------------------
      TEXT TO SPEECH SECTION
  -------------------------------*/

  const speakBtn     = document.getElementById("speak");
  const stopSpeakBtn = document.getElementById("stopSpeak");
  const ttsText      = document.getElementById("ttsText");

  speakBtn.onclick = () => {
    const text = ttsText.value.trim();
    if (!text) return alert("Type something to speak!");

    const utter = new SpeechSynthesisUtterance(text);
    utter.lang = "en-US"; // Change language if needed
    window.speechSynthesis.cancel(); // Stop previous speech
    window.speechSynthesis.speak(utter);
  };

  stopSpeakBtn.onclick = () => {
    window.speechSynthesis.cancel();
  };
</script>

</body>
</html>
