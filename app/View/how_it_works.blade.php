<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            How it works
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            <h1 class="text-2xl font-bold mb-4">Welcome!</h1>
            <p>
              It's very easy to get started using this spreadsheet. Just pick the version you're going to use, get your Coinmarketcap.com API key and submit it here. At that point you'll only need to set few settings in the actual spreadsheet. 
            </p>

            <p class="mt-2">
              Here's a quick tutorial on how to get started in case you need one: <a class="text-indigo-500" href="#">https://www.youtube.com/watch?v=ffcitRgiNDs&list=RDffcitRgiNDs</a>
            </p>

            <p class="mt-5">
              <b>Available versions:</b>
              <ul>
                <li><a class="text-indigo-500" href="#">Microsoft office (.docx)</a></li>
                <li><a class="text-indigo-500" href="#">Libre Calc (.ods)</a></li>
                <li><a class="text-indigo-500" href="#">Google Docs</a></li>

              </ul>

            </p>

            <h2 class="text-xl font-bold mt-8">Your Coinmarketcap.com API key</h2>
            <p class="text-sm text-slate-500 mb-3"><a href="#">How to get one?</a></p>


                  <form method="POST" action="/user/{{ $user->id }}">

                    @csrf
                    @method('patch')

                    <input class="border border-solid border-slate-300 rounded-lg w-full p-4" placeholder="Paste you API key here" text="" name="coinmarketcap_apikey" value="{{ $api_key }}">

                    @if (\Session::has('success'))
                        <div class="mt-2">
                            <ul>
                                <li class="text-green-600">{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="mt-4">
                      <button class="bg-indigo-500 hover:bg-indigo-400 rounded-lg text-white p-3 mr-3">Update</button>
                      <a class="text-slate-500" href="#">Test API Key</a>
                    </div>
                  </form>

   


        </div>
    </div>
</x-app-layout>