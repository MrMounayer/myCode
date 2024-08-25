<?php
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use App\Models\{FormField};

new #[Layout('layouts.app')] class extends Component {
    public $name;
    public $type;
    public $required;
    public $category;
    public $options;
    public $newOption;
    public FormField $formField;

    public function mount(FormField $formField)
    {
        $this->formField = $formField;

        $this->name = str_replace(" ","_",$this->formField->name);
        $this->type = $this->formField->type;
        $this->required = $this->formField->required;
        $this->category = $this->formField->category;
        $this->options = $this->formField->options;
    }

    public function increment()
    {
        if ($this->newOption == '') {
            return;
        }
        $this->options = [...$this->options, $this->newOption];
        $this->newOption = '';
    }

    private function clear()
    {
        $this->name = '';
        $this->type = '';
        $this->required = false;
        $this->category = '';
        $this->options = [];
    }

    public function edit(FormField $formItem)
    {
        $this->formField = $formItem;
        dd($this->formField);
        return;
    }

    public function saveField()
    {
        // dd($this->formField);
        // dd([
        //     'name' => $this->name,
        //     'type' => $this->type,
        //     'category' => $this->category,
        //     'required' => $this->required,
        //     'options' => $this->options,
        // ]);

        // this basic validation needs to be upgraded to something more secure
        if ($this->name == '' || $this->type == '' || $this->category == '') {
            return;
        }

        $this->formField->name =$this->name ; 
        $this->formField->type =$this->type ; 
        $this->formField->required =$this->required ; 
        $this->formField->category =$this->category ; 
        $this->formField->options =$this->options ; 
        
        $this->formField->save();
        // $this->form->form_fields()->updateOrCreate([
        //     'name' => $this->name,
        //     'type' => $this->type,
        //     'category' => $this->category,
        //     'required' => $this->required,
        //     'options' => $this->options,
        // ]);

        return redirect("/forms-editor/".$this->formField->form_id);
        $this->clear();
    }

    public function testing()
    {
        dd($this->form);
    }

    public function dosomething()
    {
        if ($this->type == 'dropdown') {
            $this->options = [];
        } else {
            if ($this->options != null) {
                $this->options = null;
            }
        }
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
                <select wire:model='type' wire:change='dosomething'>
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
                    wire:click.prevent="saveField">Save</button>
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
    </div>
</div>
