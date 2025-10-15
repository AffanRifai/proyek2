<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Masukkan Kode OTP</title>
  <style>
    :root {
      --bg: #0f1724;
      --card: #0b1220;
      --accent: #06b6d4;
      --muted: #94a3b8;
      --success: #10b981;
    }

    * {
      box-sizing: border-box;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    body {
      margin: 0;
      background: linear-gradient(180deg, #081124 0%, #061826 100%);
      color: #e6eef6;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    .card {
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius: 12px;
      padding: 28px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 8px 30px rgba(2,6,23,0.6);
    }

    h1 {
      margin: 0 0 6px;
      font-size: 20px;
    }

    p.lead {
      margin: 0 0 18px;
      color: var(--muted);
    }

    .otp-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 18px 0;
    }

    .otp-input {
      width: 48px;
      height: 56px;
      text-align: center;
      font-size: 22px;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.08);
      background: white;
      color: #111;
      outline: none;
      transition: all 0.2s ease;
    }

    .otp-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 6px rgba(6,182,212,0.4);
    }

    .actions {
      display: flex;
      gap: 12px;
      align-items: center;
      justify-content: center;
      margin-top: 12px;
    }

    button.btn {
      padding: 10px 14px;
      border-radius: 9px;
      border: 0;
      background: var(--accent);
      color: #042027;
      font-weight: 600;
      cursor: pointer;
    }

    button.btn[disabled] {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .link-btn {
      background: transparent;
      border: 0;
      color: var(--muted);
      cursor: pointer;
    }

    .meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 14px;
      color: var(--muted);
      font-size: 13px;
    }

    .message {
      margin-top: 12px;
      text-align: center;
      font-weight: 600;
    }

    .message.success {
      color: var(--success);
    }

    .message.error {
      color: #ef4444;
    }

    @media (max-width: 420px) {
      .otp-input {
        width: 40px;
        height: 48px;
      }
    }
  </style>
</head>
<body>
  <main class="card">
    <h1>Masukkan Kode OTP</h1>
    <p class="lead">
      Kode OTP telah dikirim ke 
      <strong>{{ $user->email }}</strong>. 
      Masukkan 6 digit kode untuk melanjutkan.
    </p>

    <form action="/verify/{{$unique_id}}" method="POST" id="otpForm" autocomplete="off">
      @csrf
      @method('PUT')

      <div class="otp-container">
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
        <input type="number" maxlength="1" class="otp-input" inputmode="numeric" required>
      </div>

      <div class="actions">
        <button type="submit" class="btn" id="submitBtn">Verifikasi</button>
        <button type="button" class="link-btn" id="resendBtn">Kirim ulang (30s)</button>
      </div>

      <div class="meta">
        <span id="tries">Percobaan tersisa: 3</span>
      </div>

      <div id="msg" class="message"></div>
    </form>
  </main>

  <script>
    const inputs = document.querySelectorAll('.otp-input');
    const resendBtn = document.getElementById('resendBtn');
    const msg = document.getElementById('msg');
    const triesEl = document.getElementById('tries');
    const RESEND_TIMEOUT = 30;
    let triesLeft = 3;

    // Auto fokus antar input
    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });

    // Gabungkan semua input ke satu nilai sebelum submit
    document.getElementById('otpForm').addEventListener('submit', function (e) {
      const otpValue = Array.from(inputs).map(i => i.value).join('');
      const hiddenInput = document.createElement('input');
      hiddenInput.type = 'hidden';
      hiddenInput.name = 'otp';
      hiddenInput.value = otpValue;
      this.appendChild(hiddenInput);
    });

    // Countdown tombol kirim ulang
    let timer = RESEND_TIMEOUT;
    const countdown = setInterval(() => {
      resendBtn.textContent = `Kirim ulang (${timer--}s)`;
      resendBtn.disabled = true;
      if (timer < 0) {
        clearInterval(countdown);
        resendBtn.disabled = false;
        resendBtn.textContent = 'Kirim ulang';
      }
    }, 1000);

    // Aksi kirim ulang
    resendBtn.addEventListener('click', () => {
      showMessage('Kode baru telah dikirim.', 'success');
      startCountdown();
    });

    function startCountdown() {
      let timer = RESEND_TIMEOUT;
      resendBtn.disabled = true;
      const cd = setInterval(() => {
        resendBtn.textContent = `Kirim ulang (${timer--}s)`;
        if (timer < 0) {
          clearInterval(cd);
          resendBtn.disabled = false;
          resendBtn.textContent = 'Kirim ulang';
        }
      }, 1000);
    }

    function showMessage(text, type = '') {
      msg.textContent = text;
      msg.className = 'message ' + type;
    }
  </script>
</body>
</html>
