<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Change password
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-pink-500">
                <span class="inline-block align-middle mr-8">
                <b class="capitalize">Error!</b> {{ $errors->first() }}.
              </span>
            </div>
            @endif

            @if (\Session::has('success'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                <b class="capitalize">Great!</b> {!! \Session::get('success') !!}</b>
              </span>
            </div>
            @endif

            <div class="bg-white p-5 rounded overflow-hidden shadow-s mt-5">

            <form method="post" action="{{ route('change-password') }}">

                @csrf
                @method('patch')

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Your current password
                    </label>
                    <input class="appearance-none border border-slate-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="old_password" required>
                </div>


                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Your new password
                    </label>
                    <input class="appearance-none border border-slate-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="new_password" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Repeat your new password
                    </label>
                    <input class="appearance-none border border-slate-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password_repeat" required>
                </div>

                <input class="mt-4 p-3 w-full bg-indigo-500 hover:bg-indigo-400 rounded-lg text-white" type="submit" value="Change password">

            </form>

    
        </div>
   


        </div>
    </div>
</x-app-layout>
