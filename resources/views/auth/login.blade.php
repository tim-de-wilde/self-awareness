<x-guest-layout>
    
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const myButton = document.getElementById('myButton');
      const myModal = document.getElementById('myModal');
      myButton.addEventListener('click', function() {
        // Toggle the 'hidden' class based on its current state
        if (myModal.classList.contains('top')) {
          myButton.classList.remove('top');
          myModal.classList.remove('top');
        } else {
          myButton.classList.add('top');
          myModal.classList.add('top');
        }
      });
    });
  </script>
  <body>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <!-- DESKTOP VERSION -->

    <div class=" justify-center items-center">
      <div class="relative z-10">
        <!--<x-my-button id="myButton" class="!rounded-full w-52 h-24 text-2xl  "> Login </x-my-button>-->
      </div>
    
 
    <div id="myModal2" class="hidden md:block flex-col items-center justify-center  insert-0 bg-[#E4F0F0] px-1 pt-20 pb-20 ">
      <div class="  overflow-hidden  transform transition-all max-w-lg w-full">
        <form method="POST" action="{{ route('login') }}"> @csrf <div class="w-full flex flex-col items-center">
            <!-- Email Address -->
            <div class=" my-4 px-2  ">
              <x-text-input id="email" class="block mt-1 w-80  !rounded-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="{{ __('Email') }}" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="my-4 px-2">
              <x-text-input id="password" class="block mt-1 w-80 !rounded-full " type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
          </div>
          <!-- Remember Me -->
          <div class="w-full flex flex-col items-center">
            <div class="flex  mt-1 justify-between  w-80 ">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('onthoud mij ') }}</span>
              </label> @if (Route::has('password.request')) <a class=" text-sm text-gray-600 hover:text-gray-900 just rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('vergeten?') }}
              </a> @endif
            </div>
          </div>
          <div class="flex justify-center items-center">
            <!---login-icon-button-->
            <x-primary-button class="inline-flex items-center ">
              <span class="inline-flex items-center justify-center p-1 bg-[#B9DDD8] rounded-full hover:bg-[#a9d6d0] active:bg-[#53aca0]">
                <x-heroicon-o-arrow-right-on-rectangle class="w-50 h-10  text-gray-800 "  />
              </span>
            </x-primary-button>
          </div>
          <div class="text-center mt-4">
            <span class="text-black">NEW TO VAMA?</span>
            <a href="/signup" class="text-orange-500 hover:text-orange-600"> SIGN UP TODAY!</a>
          </div>
        </form>
      </div>
    </div>
  <!-- MOBILE VERSION -->
  <div class="block md:hidden fixed inset-x-0 bottom-0 pb-0 safe-area-inset-bottom">
    <div class=" flex justify-center items-center">
      <div class="absolute z-10">
        <x-my-button id="myButton" class="!rounded-full w-52 h-24 text-2xl top "> Login </x-my-button>
      </div>
    </div>
    <div id="myModal" class=" top flex flex-col items-center justify-center rounded-3xl insert-0 bg-[#E4F0F0] px-1 pt-20 pb-20 transition duration-1000 ">
      <div class=" rounded-lg overflow-hidden  transform transition-all max-w-lg w-full">
        <form method="POST" action="{{ route('login') }}"> @csrf <div class="w-full flex flex-col items-center">
            <!-- Email Address -->
            <div class=" my-4 px-2  ">
              <x-text-input id="email" class="block mt-1 w-80  !rounded-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="{{ __('Email') }}" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="my-4 px-2">
              <x-text-input id="password" class="block mt-1 w-80 !rounded-full " type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
          </div>
          <!-- Remember Me -->
          <div class="w-full flex flex-col items-center">
            <div class="flex  mt-1 justify-between  w-80 ">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('onthoud mij ') }}</span>
              </label> @if (Route::has('password.request')) <a class=" text-sm text-gray-600 hover:text-gray-900 just rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('vergeten?') }}
              </a> @endif
            </div>
          </div>
          <div class="flex justify-center items-center">
            <!---login-icon-button-->
            <x-primary-button class="inline-flex items-center ">
              <span class="inline-flex items-center justify-center p-1 bg-[#B9DDD8] rounded-full hover:bg-[#a9d6d0] active:bg-[#53aca0]">
                <x-heroicon-o-arrow-right-on-rectangle class="w-50 h-10  text-gray-800 "  />
              </span>
            </x-primary-button>
          </div>
          <div class="text-center mt-4">
            <span class="text-black">NEW TO VAMA?</span>
            <a href="/signup" class="text-orange-500 hover:text-orange-600"> SIGN UP TODAY!</a>
          </div>
        </form>
      </div>
    </div>
    <style>

body {
        background-image: url('https://images.pexels.com/photos/1770706/pexels-photo-1770706.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'); /* Pfad zum Hintergrundbild */
        background-size: cover; /* Skaliert das Bild, um den Container zu füllen */
        background-position: center; /* Zentriert das Bild */
        background-attachment: fixed; /* Hintergrund bleibt beim Scrollen fest */
    }


    #myModal {
        z-index: 5; /* Stellt sicher, dass diese Elemente über dem Hintergrund liegen */
        position: relative; /* z-index funktioniert nur mit positionierten Elementen */
    }

#myButton {

    z-index: 50; /* Stellt sicher, dass diese Elemente über dem Hintergrund liegen */
    position: relative; /* z-index funktioniert nur mit positionierten Elementen */
}




    /*----Classes for myModal Slide Effect-----*/
      #myModal {
        transition: transform 0.4s ease-in-out;
        transform: translateY(0%);
        
      }

      #myModal.top {
        transform: translateY(85%);
       
      }

      #myButton {
        transition: transform 0.4s ease-in-out;
        transform: translateY(0%);
        
      }

      #myButton.top {
        transform: translateY(390%);
        
      }
      /*-----------------------------------------*/
    </style>
    </body>
</x-guest-layout>
