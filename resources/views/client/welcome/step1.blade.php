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
    <h1 class="text-center text-7xl mt-64 font-bold text-[#A4582E] ">VAMA</h1>
    <h2 class="text-center text-4xl mt-40 font-semibold ">Welkom</h2>
    <h4 class="text-center text-2xl mt-10  font-semibold">Beste App voor kinderen!</h4>
    <div class="block  fixed inset-x-0 bottom-0 pb-20 safe-area-inset-bottom">
      <div class=" flex justify-center items-center">
 
        
          <x-login-button id="beginButton" class="!rounded-full w-52 h-24 text-2xl "> Begin </x-login-button>
        
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