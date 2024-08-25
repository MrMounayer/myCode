<x-guest-layout>
    <div>
        @if ($error)
            <p class="text-sm text-red-600"> {{$error}} </p>
        @endif
        <form method="POST" action="/registration">
            @csrf
            @forelse ($fields as $formItem)
                <li wire:key="{{ $formItem->id }}"> {{ $formItem->name . '  -  ' }} 
                    @if ($formItem->required)
                        <p class="text-sm text-red-600">required</p>
                    @endif
                    <livewire:form-element wire:key="{{ $formItem->id }}" :$formItem />
                </li>
            @empty
                <p>Sorry your country is not yet supported</p>
            @endforelse
            <button name="form" value="{{ $formItem->id }}" class="p-4 mt-4 bg-red-400">Submit</button>
        </form>
    </div>
</x-guest-layout>
