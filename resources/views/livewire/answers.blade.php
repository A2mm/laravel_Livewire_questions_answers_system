<div>
    <h1 class="text-3xl">Answers</h1>
    @error('newAnswer') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    <div>
        @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
            {{ session('message') }}
        </div>
        @endif
    </div>

 
    <section>
        @if($image)
        <img src={{$image}} width="200" />
        @endif
        <input type="file" id="image" wire:change="$emit('fileChoosen')">
    </section>

    <form class="my-4 flex" wire:submit.prevent="addAnswer">
        <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="add answer."
            wire:model.debounce.500ms="newAnswer">
        <div class="py-2">
            <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
        </div>
    </form>
    @foreach($answers as $answer)
    <div class="rounded border shadow p-3 my-2">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="font-bold text-lg">{{$answer->user->name}}</p>
                <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$answer->created_at->diffForHumans()}}
                </p>
            </div>
            <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer"
                wire:click="remove({{$answer->id}})"></i>
        </div>
        <p class="text-gray-800">{{$answer->body}}</p>
        
        @if($answer->image)
        <img src="{{asset('storage/'.$answer->image)}}">
        @endif
       
    </div>
    @endforeach

    {{$answers->links('pagination-links')}}
</div>

<script>
    window.livewire.on('fileChoosen', () => {
        let inputField = document.getElementById('image')
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);

    })
</script> 
