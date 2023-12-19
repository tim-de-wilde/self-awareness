<x-guest-layout role="client">
  <!---NOTE-->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const beginButton = document.getElementById('beginButton');
    });
  </script>
  <body>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-center text-4xl mt-64 font-bold ">YOU’RE DONE! </h1>
    <h1 class="text-center text-3xl mt-20 font-semibold ">You are now ready
to start </h1>
    
   <div class="block fixed inset-x-0 bottom-0 pb-20 safe-area-inset-bottom">
  <div class="flex justify-center items-center">

  
  
  
    
     
     <div class="flex flex-col items-center  ">
          <!-- Kreise über dem ersten Button -->
          <div class="flex mb-10">
            <div class="w-3 h-3 bg-[#45CDC5] rounded-full"></div>
            <div class="w-3 h-3 bg-[#45CDC5] rounded-full ml-1"></div>
            <div class="w-3 h-3 bg-[#45CDC5] rounded-full ml-1"></div>
            <div class="w-3 h-3 bg-[#45CDC5] rounded-full ml-1"></div>
            <div class="w-3 h-3 bg-[#45CDC5] rounded-full ml-1"></div>
          </div>
          
    
    
    
<div class="flex">
      <!-- Erster Button mit Pfeil-Icon -->
      <x-login-button id="iconButton" class="!rounded-full w-28 h-24 text-2xl mr-2 flex items-center justify-center">
        <x-heroicon-o-arrow-left class="h-9 text-gray-800" />
      </x-login-button>

      <!-- Zweiter Button mit "Begin" Text -->
      <x-login-button id="beginButton" class="!rounded-full w-64 h-24 text-2xl relative">
     Finish
      </x-login-button>
      </div>

    </div>
 
</div>
</div>
      </div>
      <style>
        @media screen and (max-width: 3000px) {
          body {
            /*background-image: url('https://images.pexels.com/photos/1770706/pexels-photo-1770706.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'); /* Pfad zum Hintergrundbild */
            background-color: #E4EFEF;
            background-size: cover;
            /* Skaliert das Bild, um den Container zu füllen */
            background-position: center;
            /* Zentriert das Bild */
            background-attachment: fixed;
            /* Hintergrund bleibt beim Scrollen fest */
          }
        }
        }
      </style>
  </body>
</x-guest-layout>