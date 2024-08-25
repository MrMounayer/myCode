<?php

use Livewire\Volt\Component;

new class extends Component {
    public $formItem;
    
}; ?>

<div>
    @switch($formItem->type)
    @case("text")
        <input type="text" name="{{$formItem->name}}" >
        @break
    @case("file")
        <input type="file" name="{{$formItem->name}}" >
        @break
    @case("checkbox")
        <input type="checkbox" name="y{{$formItem->name}}" >
    @break
    @case("date")
        <input type="date" name="{{$formItem->name}}" >
    @break
    @case("dropdown")
        <select name="{{$formItem->name}}" >
            @foreach ($formItem["options"] as $option)
                <option value="{{$option}}"> {{$option}} </option>
            @endforeach
        </select>
    @break
    @default
        
@endswitch
</div>
