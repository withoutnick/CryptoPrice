<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Setup
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            <h1 class="text-3xl font-bold mb-8">Welcome!</h1>
            <p>
              It's very easy to get started using this spreadsheet. Just pick the version you're going to use, get your Coinmarketcap.com API key and submit it here. At that point you'll only need to set few settings in the actual spreadsheet. 
            </p>

            <div class="mt-4 bg-indigo-100 p-5 text-indigo-900 rounded-lg">
 
              I highly recommend spending 10 minutes reviewing <a class="text-indigo-900 hover:underline font-bold" href="#">introductionary video</a> before moving on with the setup. This might save you a ton of time down the road.</a>
            </a>
            
            </div>

            <p class="mt-5">
              <b>Available versions:</b>
              <ul>
                <li><a href="/files/spreadsheet_msoffice.xlsx" class="text-indigo-500 hover:underline" href="#">Microsoft office (.xlsx)</a></li>
                <li><a href="/files/spreadsheet_libreoffice.ods" class="text-indigo-500 hover:underline" href="#">Libre Calc (.ods)</a></li>
                <li><a target="_blank" href="https://docs.google.com/spreadsheets/d/1MtWgeI96lrWVRZqJ6kOn8-sxvi24i2h4AWpW0m_rEng/edit?usp=sharing" class="text-indigo-500 hover:underline">Google Spreadsheets</a></li>

              </ul>

            </p>

            <h2 class="text-xl font-bold mt-8">Your secret code</h2>
            <p class="text-sm text-slate-500 mb-3">Copy and paste this into your spreadsheet's settings page</p>
            <div>
              <input class="border border-solid border-slate-300 rounded-lg w-full p-4" disabled type="text" value="{{ md5($user->email) }}">
            </div>

            <h2 class="text-xl font-bold mt-8">Your Coinmarketcap.com API key</h2>
            <p class="text-sm text-slate-500 mb-3">Take a look at the  <a class="text-indigo-500 hover:underline" href="{{ route('cpc-api-key') }}">guide</a></p>


                  <form method="POST" action="/user/{{ $user->id }}">

                    @csrf
                    @method('patch')

                    <input type="password" class="border border-solid border-slate-300 rounded-lg w-full p-4" placeholder="Paste you API key here" text="" name="coinmarketcap_apikey" value="{{ $api_key }}">

                    @if (\Session::has('success'))
                        <div class="mt-2">
                            <ul>
                                <li class="text-green-600">{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-2">
                            <ul>
                                <li class="text-red-600">{!! $errors->first() !!}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="mt-4">
                      <button class="bg-indigo-500 hover:bg-indigo-400 rounded-lg text-white p-3 mr-3">Update</button>
                      <a class="text-slate-500" href="{{ route('test-api-key') }}">Test API Key</a>
                    </div>
                  </form>

   


        </div>
    </div>

</x-app-layout>
