<!DOCTYPE html>
<html>
<head>
    <title>Speech to Text</title>
</head>
<body>

<h2>Cross-Browser Speech to Text</h2>

<button id="startBtn">Start Recording</button>
<button id="stopBtn" disabled>Stop</button>

<p id="status">Idle…</p>

<textarea id="output" rows="10" style="width:100%"></textarea>

<script>
let recorder;
let chunks = [];

const startBtn = document.getElementById('startBtn');
const stopBtn = document.getElementById('stopBtn');
const status = document.getElementById('status');
const output = document.getElementById('output');

async function init() {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    recorder = new MediaRecorder(stream);

    recorder.onstart = () => {
        chunks = [];
        status.textContent = "Recording…";
        startBtn.disabled = true;
        stopBtn.disabled = false;
    };

    recorder.ondataavailable = (e) => {
        if (e.data.size > 0) chunks.push(e.data);
    };

    recorder.onstop = async () => {
        status.textContent = "Processing…";
        startBtn.disabled = false;
        stopBtn.disabled = true;

        const blob = new Blob(chunks, { type: 'audio/webm' });
        const formData = new FormData();
        formData.append("file", blob, "audio.webm");

        const response = await fetch("{{ route('speech.transcribe') }}", {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        output.value = data.text ?? "No transcription result.";
        status.textContent = "Done.";
    };
}

startBtn.onclick = async () => {
    if (!recorder) await init();
    recorder.start();
};

stopBtn.onclick = () => recorder.stop();
</script>

</body>
</html>
