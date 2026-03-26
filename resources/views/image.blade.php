<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 h-screen flex flex-col">

    <main class="flex-1 flex flex-col items-center justify-center p-8 relative overflow-hidden">

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gray-200 rounded-full opacity-20 blur-3xl -z-10"></div>

        <div class="text-center max-w-lg w-full">

            <div class="mb-6 flex justify-start">
                <a href="{{ route('user.dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-white text-gray-600 text-sm font-semibold rounded-md border border-gray-200 shadow-sm hover:bg-gray-50 hover:text-black transition-all duration-300">

                    ← Back
                </a>
            </div>

            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-black mb-3">Upload Image</h1>
                <p class="text-gray-500 text-lg">
                    Add or update your profile picture
                </p>
            </div>
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
                @csrf
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Choose Image
                    </label>

                    <input type="file" name="image" required
                        class="block w-full text-sm text-gray-600 
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-black file:text-white
                        hover:file:bg-gray-800
                        border border-gray-200 rounded-lg cursor-pointer bg-gray-50">
                </div>
                <button type="submit"
                    class="group relative inline-flex items-center justify-center w-full px-8 py-4 bg-black text-white text-base font-semibold rounded-lg shadow-lg hover:bg-gray-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    Upload Image
                </button>
            </form>

            @if(Auth::user()->image)
            <div class="mt-10">
                <p class="text-gray-500 mb-3">Current Image</p>
                <img src="{{ asset('storage/' . Auth::user()->image->path) }}"
                    class="mx-auto w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg transition-transform duration-300 hover:scale-105">
            </div>
            @endif

        </div>
    </main>

</body>

</html>