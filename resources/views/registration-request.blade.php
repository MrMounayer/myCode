<x-guest-layout>
<div>
    <h2>Choose the country first to proceed</h2>

    <form method="get" action="/registration">
        <select name="country" wire:model='country' wire:change='handleCountry'>
            @forelse ($forms as $form)
                <option value="{{ $form->country }}">{{ $form->country }}</option>
            @empty
                <option value="">No options available</option>
            @endforelse
        </select>
        <div class="my-4">

        </div>
        <button class="p-4 bg-red-400 hover:bg-red-500">Submit</button>
    </form>

</div>
    
</x-guest-layout>