<div class="h-full py-8 bg-[#E4EFEF]">
    <div class="max-w-4xl mx-auto p-4 ">
        <div class="divide-y divide-gray-200">
            @foreach($stagedQuestions as $question)
                <div class="bg-white p-2">
                    <p>{{ $question->title }}</p>
                    <p>{{ $question->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
