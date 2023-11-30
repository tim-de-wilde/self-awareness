<x-app-layout role="client">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const arrowButton = document.getElementById('arrowButton');
      const infoModal = document.getElementById('infoModal');
      
      infoModal.addEventListener('click', toggleModalAndButton);
    });

    function toggleModalAndButton() {
        infoModal.classList.toggle('top');
    }

    function handleChevronClick() {
      // Fügen Sie hier Ihre Logik für das Klicken auf das Chevron-Icon hinzu
      console.log("Chevron geklickt!");
    }
  </script>
  <div class="h-full">
    <div class=" h-full py-1 font-serif bg-[#E4EFEF]">
      <div class="p-3 text-gray-900 flex justify-center  ">
        <x-avatar :user="$currentUser" size="32" /> <!---(Error) cant change the size-->
      </div>
      <!--bg-[#E4EFEF]-->
      <div class=" overflow-hidden shadow-sm sm:rounded-lg justify-center flex">
        <!-- Info Modal-->
        <div id="" class="w-10/12 cursor-pointer ">
          <!-- Flex Container for Name and Icon -->
          <div id="infoModal" class="bg-[#FFFFFF] p-6 rounded-3xl shadow-lg mb-5 ">
            <div class="flex justify-between items-center mb-8">
              <!-- inside Container for centered Name -->
              <div class="flex-grow text-center">
                <div class="text-2xl font-extrabold ml-10">{{ $currentUser->name . ' ' . $currentUser->last_name }} </div>
              </div>
              <!-- Icon -->
              <button id="arrowButton"  class="focus:outline-none ">
                <x-heroicon-o-chevron-down class="h-9 text-gray-800 " />
              </button>
            </div>
            
            <div class="flex items-center ">
              <x-heroicon-o-academic-cap class="h-5 text-gray-800" />
              <span class="font-bold text-lg ml-2">Email:</span>
            </div>
            <span class="font-serif block mt-2 ml-1">{{$currentUser->email}}</span>
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

          @forelse($questionnaires as $questionnaire)
            <x-questionnaire-overview-card :questionnaire="$questionnaire"/>
          @empty
            <span class="italic">
              Er zijn momenteel geen vragenlijsten beschikbaar.
            </span>
          @endforelse
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
    </style>
  </div>
</x-app-layout>