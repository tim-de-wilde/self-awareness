<x-app-layout role="psychologist">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const arrowButton = document.getElementById('arrowButton');
      const infoModal = document.getElementById('infoModal');
      arrowButton.addEventListener('click', function() {
        infoModal.classList.toggle('top');
        arrowButton.classList.toggle('top');
      });
    });

    function handleChevronClick() {
      // Fügen Sie hier Ihre Logik für das Klicken auf das Chevron-Icon hinzu
      console.log("Chevron geklickt!");
    }
  </script>
  <body>
    <div class="py-1 font-serif bg-[#E4EFEF] ">
      <div class="p-3 text-gray-900 flex justify-center  ">
        <x-avatar :user="$currentUser" size="12" class="custom-avatar-size" /> <!---(Error) cant change the size-->
      </div>
      <!--bg-[#E4EFEF]-->
      <div class=" overflow-hidden shadow-sm sm:rounded-lg justify-center flex">
        <!-- Info Modal-->
        <div id="" class="w-10/12 ">
          <!-- Flex Container for Name and Icon -->
          <div id="infoModal" class="bg-[#FFFFFF] p-6 rounded-3xl shadow-lg mb-5 ">
            <div class="flex justify-between items-center mb-8">
              <!-- inside Container for centered Name -->
              <div class="flex-grow text-center">
                <div class="text-2xl font-extrabold ml-10">Kate Williams </div>
              </div>
              <!-- Icon -->
              <button id="arrowButton" onclick="handleChevronClick()" class="focus:outline-none ">
                <x-heroicon-o-chevron-down class="h-9 text-gray-800 " />
              </button>
            </div>
            <!-- Info Modal -->
            <div class="flex items-center ">
              <x-heroicon-o-academic-cap class="h-5 text-gray-800" />
              <span class="font-bold text-lg ml-2">Email:</span>
            </div>
            <span class="font-serif block mt-2 ml-1">katewilliams@email.de</span>
            <hr class="border-t border-gray-300 my-5">
            <div class="flex items-center">
              <x-heroicon-o-envelope class="h-5 text-gray-800" />
              <span class="font-bold text-lg ml-2">School:</span>
            </div>
            <span class="font-serif block mt-2 ml-1">Dollard College</span>
            <hr class="border-t border-gray-300 my-5">
            <div class="flex items-center">
              <x-heroicon-o-user class="h-5 text-gray-800" />
              <span class="font-bold text-lg ml-2">Parent:</span>
            </div>
            <span class="font-serif block mt-2 ml-1">Anna Wilhemls</span>
            <hr class="border-t border-gray-300 my-5">
          </div>
          <div class="items-center flex justify-center mx-auto my-5 bg-[#B9DDD8]">
            <span class="font-bold text-1xl ">Vragen</span>
          </div>
          <!--Card-1-->
          <div class=" p-1 mt-5  mx-auto bg-[#FAE7CD] shadow-lg  overflow-hidden rounded-2xl relative">
            <div class="p-4">
              <!-- Titel -->
              <h2 class="text-2xl font-extrabold mb-3">Stemming</h2>
              <!-- Beschreibung -->
              <p class=" font-thin  text-gray-700  mb-4 "> Deze vragen helpen u bij uw stemming. </p>
              <!-- Button -->
              <button class="bg-[#E1A24C] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
            </div>
          </div>
          <!--Card-2-->
          <div class=" p-1 my-5 mx-auto bg-[#FCDDCC] shadow-lg  overflow-hidden rounded-2xl relative">
            <div class="p-4">
              <!-- Titel -->
              <h2 class="text-2xl font-extrabold mb-3">Gevoel</h2>
              <!-- Beschreibung -->
              <p class=" font-thin  text-gray-700  mb-4 "> Deze vragen helpen u bij uw gevoelens. </p>
              <!-- Button -->
              <button class="bg-[#FFA26F] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
            </div>
          </div>
          <!--Card-3-->
          <div class=" p-1 my-5 mx-auto bg-[#E5EBC0] shadow-lg  overflow-hidden rounded-2xl relative">
            <div class="p-4">
              <!-- Titel -->
              <h2 class="text-2xl font-extrabold mb-3">Gepersonaliseerd</h2>
              <!-- Beschreibung -->
              <p class=" font-thin  text-gray-700  mb-4 "> Dit zijn gepersonaliseerde vragen. </p>
              <!-- Button -->
              <button class="bg-[#C1CE73] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
            </div>
          </div>
          <!--Here comes more cards-->
        </div>
      </div>
    </div>
    <style>
      body {
        /*  background color*/
        /*background-image: url('https://images.pexels.com/photos/1770706/pexels-photo-1770706.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'); /* Pfad zum Hintergrundbild */
      }

      /*----Classes for myModal Slide Effect-----*/
      #infoModal {
        transition: all 0.3s ease-in-out;
        height: 80px !important;
        /* Anfangshöhe des Modals */
        overflow: hidden;
      }

      #infoModal.top {
        height: 430px !important;
        height: d
      }

      #arrowButton {}

      #arrowButton.top {
        transform: rotate(180deg);
      }

      .custom-avatar-size {
        width: 95px;
        height: 80px;
      }
    </style>
  </body>
</x-app-layout>