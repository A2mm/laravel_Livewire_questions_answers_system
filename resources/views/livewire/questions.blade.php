<div>
    <h1 class="text-3xl">Questions</h1>
    @foreach($questions as $question)
    <div class="rounded border shadow p-3 my-2 {{$active == $question->id ? 'bg-green-200':''}}"
        wire:click="$emit('questionSelected',{{$question->id}})">
        <p class="text-gray-800">{{$question->question}}</p>
    </div>
    @endforeach
</div>