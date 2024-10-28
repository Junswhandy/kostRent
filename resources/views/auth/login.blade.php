<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-xl rounded-3xl px-10 py-8 max-w-md w-full">
            <h1 class="text-center text-3xl font-bold mb-6">Login</h1>
            <hr class="mb-6">

            <!-- Session Status -->
            <!-- If you are using Blade components, include session status here -->
            <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <input type="email" name="email" id="email" class="py-3 px-5 rounded-md bg-zinc-50 w-full outline-indigo-400 focus:ring focus:ring-indigo-200" placeholder="Enter your email" required>
                    <!-- Error Message -->
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <input type="password" name="password" id="password" class="py-3 px-5 rounded-md bg-zinc-50 w-full outline-indigo-400 focus:ring focus:ring-indigo-200" placeholder="Enter your password" required>
                    <!-- Error Message -->
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Forgot Password Link -->
                <div class="flex justify-end mb-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="py-3 bg-indigo-500 text-white w-full rounded-md font-bold hover:bg-indigo-600">Login</button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-6">
                <p>Don't have an account? <a href="{{ route('register') }}" class="text-indigo-500 font-bold hover:underline">Register</a></p>
            </div>
        </div>
    </div>

</body>
</html>
