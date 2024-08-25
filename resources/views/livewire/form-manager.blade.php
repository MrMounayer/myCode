<?php
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use App\Models\{Form, FormField};

new #[Layout('layouts.app')] class extends Component {
    public $name = '';
    public $type = '';
    public $required = false;
    public $category = '';
    public $options;
    public $newOption = '';
    public Form $form;


    public function increment()
    {

        if ($this->newOption == '') {
            return;
        }
        $this->options = [...$this->options,$this->newOption];
        $this->newOption = "";
    }

    private function clear()
    {
        $this->name = "";
        $this->type = "";
        $this->required = false;
        $this->category = "";
        $this->options = [];
    }

    public function edit(FormField $formItem)
    {
        $this->formField = $formItem;
        dd($this->formField);
        return;
    }

    public function save()
    {
        // this basic validation needs to be upgraded to something more secure
        if($this->name =="" || $this->type =="" || $this->category =="") return ;
        
        $this->saveField();

        $this->clear();
        return [];
    }

    public function saveField()
    {
        // dd([
        //     'name' => $this->name,
        //     'type' => $this->type,
        //     'category' => $this->category,
        //     'required' => $this->required,
        //     'options' => $this->options,
        // ]);

            

            $this->form->form_fields()->create([
                'name' => str_replace(" ","_",$this->name),
                'type' => $this->type,
                'category' => $this->category,
                'required' => $this->required,
                'options'=>$this->options,
        ]);

        
    }

    public function delete(FormField $formField)
    {
        $formField->delete();
    }

    public function dropDownHandler()
    {
        if ($this->type == 'dropdown') {
            $this->options = [];
        } else {
            if ($this->options != null) {
                $this->options = null;
            }
        }
    }

    public function with()
    {
        return [
            'formItems' => FormField::latest()
                ->where('form_id', '=', $this->form?->id)
                ->get(),
        ];
    }
}; ?>

<div>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Form Editor') }}
        </h2>
    </x-slot>
    <div class="grid gap-2 p-4 grid-rows">
        <div class="">

            <h2>Form customizer</h2>
        </div>
        <form>
            <div class="">
                <input type="text" wire:model='name' placeholder="Field Name">
                <select wire:model='type' wire:change='dropDownHandler'>
                    <option value="" selected disabled>input type</option>
                    <option value="text">text</option>
                    <option value="date">date</option>
                    <option value="dropdown">dropdown</option>
                    <option value="checkbox">checkbox</option>
                </select>
                <select wire:model='category'>
                    <option value="" sepected disabled>info type</option>
                    <option value="General Information">General Information</option>
                    <option value="Identity">Identity</option>
                    <option value="Bank Related">Bank Related</option>
                </select>
                <label>
                    is Required ?
                    <input type="checkbox" wire:model='required'>
                </label>
                <button type="submit" class="p-2 rounded-md hover:bg-cyan-500 bg-cyan-400"
                    wire:click.prevent="save">Save</button>
            </div>
            <div class="my-2">
                @if ($type == 'dropdown')
                    <div class="flex flex-col gap-2">
                        <div>
                            <button type="button" class="p-2 rounded-md hover:bg-cyan-500 bg-cyan-400"
                                wire:click.prevent="increment">add option</button>
                            <input type="text" name="option" wire:model.live6='newOption' placeholder="option">
                        </div>
                        <ul class="flex gap-4">
                            @foreach ($options as $option)
                                <li class="p-4 "> {{ $option }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </form>
        <hr>
        <ul class="flex flex-col gap-4">
            @forelse ($formItems as $formItem )
            <li class="flex gap-2" wire:key = "wire:key="{{$formItem->id}}"">
                
                <livewire:form-element :$formItem > <a href="/fields-editor/{{$formItem->id}}" class="p-2 bg-orange-400 ">edit</a><button class="p-2 bg-red-400 " wire:click="delete({{$formItem}})">delete</button>
            </li>
                @empty
                    <li>no fields to show</li>
            @endforelse
        </ul>
    </div>
</div>
