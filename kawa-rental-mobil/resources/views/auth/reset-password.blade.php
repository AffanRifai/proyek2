<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-center text-[#a62f19] mb-3">Reset Password</h2>
    <p class="text-center text-gray-500 text-sm mb-6">
      Masukkan password baru untuk email <strong>{{ $email }}</strong> kamu di bawah ini.
    </p>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 text-sm p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <label for="password" class="block font-medium text-gray-700 mb-1">Password Baru</label>
      <input id="password" name="password" type="password" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-[#a62f19] focus:border-[#a62f19] outline-none">

      <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
      <input id="password_confirmation" name="password_confirmation" type="password" required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-6 focus:ring-2 focus:ring-[#a62f19] focus:border-[#a62f19] outline-none">

      <button type="submit"
        class="w-full bg-[#a62f19] hover:bg-[#8e2613] text-white font-semibold py-2 rounded-lg transition-all duration-300 transform hover:scale-[1.02]">
        Reset Password
      </button>
    </form>
  </div>

</body>
</html>
