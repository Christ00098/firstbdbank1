let isLoggedIn = false;
let recognition = null;
let synth = window.speechSynthesis;
let isListening = false;

// 🔑 CRITICAL: Initialize speech AFTER user interaction
document.addEventListener('DOMContentLoaded', () => {
  // Preload voices (async)
  loadVoices();

  // Try to initialize on first click
  document.getElementById('micBtn')?.addEventListener('click', () => {
    if (!recognition) initRecognition();
  });
});

function loadVoices() {
  // Voices may not be loaded on page load — listen for change
  synth.addEventListener('voiceschanged', () => {
    console.log("✅ Voices loaded:", synth.getVoices().length);
  });
  // Force refresh
  synth.getVoices();
}

function initRecognition() {
  // 🔴 SAFETY: Only initialize once
  if (recognition) return recognition;

  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  if (!SpeechRecognition) {
    alert("⚠️ Voice not supported. Use Chrome, Edge, or Android.");
    return null;
  }

  recognition = new SpeechRecognition();
  recognition.continuous = false;
  recognition.interimResults = false;
  recognition.lang = 'en-GB'; // UK English

  recognition.onstart = () => {
    isListening = true;
    document.getElementById('micBtn')?.classList.add('listening');
    document.querySelector('.container')?.classList.add('listening');
    updateStatus("🗣️ Listening...");
  };

  recognition.onend = () => {
    isListening = false;
    document.getElementById('micBtn')?.classList.remove('listening');
    document.querySelector('.container')?.classList.remove('listening');
    if (!recognition.resultFinal) {
      updateStatus("⏹️ Stopped");
      setTimeout(() => updateStatus("Idle"), 1500);
    }
  };

  recognition.onresult = (event) => {
    const transcript = event.results[0][0].transcript;
    console.log("🗣️ Recognized:", transcript);
    recognition.resultFinal = transcript;// Mark as final
    handleVoiceInput(transcript);
  };

  recognition.onerror = (event) => {
    console.error("Speech error:", event.error);
    let msg = "❌ ";
    switch (event.error) {
      case 'no-speech': msg += "No speech detected"; break;
      case 'audio-capture': msg += "Microphone access denied"; break;
      case 'not-allowed': msg += "Permission blocked"; break;
      default: msg += event.error;
    }
    updateStatus(msg);
    setTimeout(() => updateStatus("Idle"), 3000);

    // 🔑 CRITICAL: Request permission if denied
    if (event.error === 'not-allowed' || event.error === 'audio-capture') {
      alert("🔒 Please allow microphone access in your browser settings.");
    }
  };

  return recognition;
}

function updateStatus(text) {
  const el = document.getElementById('status');
  if (el) {
    el.textContent = text;
    // Add class for color (optional)
    el.className = 'status';
    if (text.includes('🗣️')) el.classList.add('listening');
    else if (text.includes('🧠')) el.classList.add('thinking');
    else if (text.includes('🔊')) el.classList.add('speaking');
  }
}

function toggleVoice() {
  //if (!isLoggedIn) {
  //alert("🔐 Please log in first.");
  //return;
  //}

  // 🔑 CRITICAL: Ensure recognition is initialized
  if (!recognition) {
    recognition = initRecognition();
    if (!recognition) return;
  }

  if (isListening) {
    recognition.stop();
  } else {
    // 🔑 CRITICAL: User gesture = button click → allowed
    recognition.start();
  }
}

// --- Login & Chat Functions (unchanged, but included for completeness) ---

function login() {
  const acc = document.getElementById('accountNumber')?.value?.trim();
  const pwd = document.getElementById('password')?.value?.trim();

  if (!acc || !/^\d{10}$/.test(acc)) {
    alert('⚠️ Please enter a 10-digit account number.');
    return;
  }
  if (!pwd) {
    alert('⚠️ Password is required.');
    return;
  }

  updateStatus("🔐 Logging in...");

  fetch('login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `account=${encodeURIComponent(acc)}&password=${encodeURIComponent(pwd)}`
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        isLoggedIn = true;
        document.getElementById('loginSection').style.display = 'none';
        document.getElementById('inputArea').style.display = 'flex';
        document.getElementById('voiceControls').style.display = 'block';

        appendMessage(`✅ Welcome, ${data.name}!`, 'bot');
        appendMessage(`Your balance: ${data.balance}`, 'bot');
        appendMessage("What do you want to do today? Type or say:\n• \"What's my balance?\"\n• \"Last transaction?\"\n• \"Branch hours?\"\n• \"My profile?\"", 'bot');
      } else {
        alert('❌ Login failed: ' + (data.error || 'Invalid credentials'));
        updateStatus("Idle");
      }
    })
    .catch(err => {
      alert('⚠️ Server error. Is PHP running?');
      updateStatus("Idle");
    });
}

function handleVoiceInput1(text) {
  appendMessage(text, 'user');
  document.querySelector('.container')?.classList.add('thinking');
  updateStatus("🧠 Processing...");

  fetch('chat.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `query=${encodeURIComponent(text)}`
  })
    .then(res => res.json())
    .then(data => {
      document.querySelector('.container')?.classList.remove('thinking');
      speakAndDisplay(data.response);
    })
    .catch(err => {
      document.querySelector('.container')?.classList.remove('thinking');
      updateStatus("❌ Error");
      appendMessage("Sorry, I couldn’t process that.", 'bot');
    });
}

function handleVoiceInput(text) {
  appendMessage(text, 'user');
  document.querySelector('.container')?.classList.add('thinking');
  const chi = document.getElementById('Chi')?.value?.trim();
  updateStatus("🧠 Processing...");

  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    fetch("chat", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf
      },
      body: JSON.stringify({ query: text + ' @@% ' + chi  })
    })
      .then(res => res.json())
      .then(data => {
        document.querySelector('.container')?.classList.remove('thinking');
        if(data.response === "Logged out successfully."){
          window.location.reload();
        }
        if(data.response === "To register, please visit our registration page and fill out the required information."){
          window.location.href = "http://localhost/pspeach/public/register";
        }
        speakAndDisplay(data.response);
        document.getElementById('Chi').value = data.chig;
        console.log(document.getElementById('Chi')?.value?.trim());

      })
      .catch(err => {
        document.querySelector('.container')?.classList.remove('thinking');
        updateStatus("❌ Error");
        appendMessage("Sorry, I couldn’t process that." + err, 'bot');
      });
  
}

function sendMessage() {
  const input = document.getElementById('userInput');
  const chi = document.getElementById('Chi')?.value?.trim();
  const text = input?.value?.trim();
  if (!text) return;

  appendMessage(text, 'user');
  input.value = '';

  document.querySelector('.container')?.classList.add('thinking');
  updateStatus("🧠 Processing...");

  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch("chat", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf
    },
    body: JSON.stringify({ query: text + ' @@% ' + chi })
  })
    .then(res => res.json())
    .then(data => {
      document.querySelector('.container')?.classList.remove('thinking');
      if(data.response === "Logged out successfully."){
          window.location.reload();
        }
        if(data.response === "To register, please visit our registration page and fill out the required information."){
          window.location.href = "http://localhost/pspeach/public/register";
        }
      speakAndDisplay(data.response);
      document.getElementById('Chi').value = data.chig;
    })
    .catch(err => {
      console.error(err);
      updateStatus("❌ Error communicating with server.");
    });
}


function sendMessage111() {
  const input = document.getElementById('userInput');
  const text = input?.value?.trim();
  if (!text) return;

  appendMessage(text, 'user');
  if (input) input.value = '';
  document.querySelector('.container')?.classList.add('thinking');
  updateStatus("🧠 Processing...");

  fetch('chat.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `query=${encodeURIComponent(text)}`
  })
    .then(res => res.json())
    .then(data => {
      document.querySelector('.container')?.classList.remove('thinking');
      speakAndDisplay(data.response);
    });
}

function speakAndDisplay(text) {
  appendMessage(text, 'bot');

  // 🔑 CRITICAL: Cancel any pending speech
  if (synth.speaking) {
    synth.cancel();
  }

  const utterance = new SpeechSynthesisUtterance(text);
  utterance.lang = 'en-GB';
  utterance.rate = 0.92;
  utterance.pitch = 1;

  // 🔑 CRITICAL: Wait for voices to load
  let voices = synth.getVoices();
  if (voices.length === 0) {
    // Voices not loaded yet — wait and retry
    synth.addEventListener('voiceschanged', () => {
      voices = synth.getVoices();
      utterance.voice = getPreferredVoice(voices);
      synth.speak(utterance);
    }, { once: true });
    return;
  }

  utterance.voice = getPreferredVoice(voices);

  utterance.onstart = () => {
    document.querySelector('.container')?.classList.add('speaking');
    updateStatus("🔊 Speaking...");
  };

  utterance.onend = () => {
    document.querySelector('.container')?.classList.remove('speaking');
    updateStatus("Idle");
  };

  utterance.onerror = (e) => {
    console.error("Speech synthesis error:", e);
    updateStatus("🔇 Speech failed");
  };

  synth.speak(utterance);
}

function getPreferredVoice(voices) {
  return (
    voices.find(v => v.name.includes('Google UK English')) ||
    voices.find(v => v.lang === 'en-GB') ||
    voices.find(v => v.lang.startsWith('en')) ||
    voices[0]
  );
}

function appendMessage(text, sender) {
  const chatBox = document.getElementById('chatBox');
  if (!chatBox) return;

  const msgDiv = document.createElement('div');
  msgDiv.classList.add('message', sender);
  msgDiv.innerHTML = sender === 'bot' ? text.replace(/\n/g, '<br>') : text;
  chatBox.appendChild(msgDiv);
  chatBox.scrollTop = chatBox.scrollHeight;
}

// --- Fallback: Enable Enter key ---
document.addEventListener('keypress', (e) => {
  if (e.key === 'Enter' && e.target.id === 'userInput') {
    sendMessage();
  }
});