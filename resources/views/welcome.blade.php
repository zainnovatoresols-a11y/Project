<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MyApp') }}</title>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800 font-sans">

    <header class="w-full px-6 py-4 flex justify-between items-center bg-white shadow">
        <h1 class="text-lg font-semibold">
            {{ config('app.name', 'MyApp') }}
        </h1>

        <div class="flex items-center space-x-2">
            <a href="{{ route('login') }}"
                class="px-4 py-2 text-sm border border-gray-300 rounded-md text-gray-800 hover:bg-gray-100 transition">
                Login
            </a>

            <a href="{{ route('users.create') }}"
                class="px-4 py-2 text-sm bg-black text-white rounded-md hover:bg-black-900 transition">
                Register
            </a>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-1 flex items-center justify-center px-6 text-center">
        <div class="max-w-md w-full">
            <h2 class="text-2xl sm:text-3xl font-bold mb-4">
                Welcome to {{ config('app.name', 'MyApp') }}
            </h2>

            <p class="text-gray-500 mb-6">
                Get started by logging in or creating a new account.
            </p>

            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 border border-gray-300 rounded-md text-gray-800 hover:bg-gray-100 transition">
                    Login
                </a>

                <a href="{{ route('users.create') }}"
                    class="px-6 py-3 bg-black text-white rounded-md hover:bg-gray-900 transition">
                    Register
                </a>
            </div>
        </div>
    </main>

</body>

</html>