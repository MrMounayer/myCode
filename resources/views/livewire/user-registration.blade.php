<?php
use Livewire\Attributes\{Layout};
use App\Models\{Form, FormField};
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public $country;
    public $fields = [];
    public $form = [];
    public $value;
    public function handleCountry()
    {
        $this->fields = Form::where('country', $this->country)
            ->first()
            ?->form_fields()
            ->latest()
            ->get();
    }
    public function save()
    {
        dd($this->value);
    }
    public function with()
    {
        return [
            // "fields"=>FormField::latest()->get(),
            'forms' => Form::latest()->get(),
        ];
    }
}; ?>

<div>
    <h2>Choose the country first to proceed</h2>

    <select name="country" wire:model='country' wire:change='handleCountry'>
        @forelse ($forms as $form)
            <option value="{{ $form->country }}">{{ $form->country }}</option>
        @empty
            <option value="">No options available</option>
        @endforelse
    </select>
    <form>
        <div class="my-4">
            {{-- @forelse ($fields as $formItem)
                <li wire:key="{{ $formItem->id }}"> {{ $formItem->name . '  -  ' }} <livewire:form-element
                        wire:key="{{ $formItem->id }}" :$formItem :$value/></li>
            @empty
                <p>Sorry your country is not yet supported</p>
            @endforelse --}}

        </div>
        <button class="p-4 bg-red-400 hover:bg-red-500" wire:click.prevent='save'>Submit</button>
    </form>

</div>
