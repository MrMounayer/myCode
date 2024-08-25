<?php
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use App\Models\Form;
use Illuminate\Routing\Route;

new 
#[Layout('layouts.app')]
class extends Component {
    
    public $country="";
    public $test = "";
    public $error="";
    
    public function create()
    {
        // dd($this->country);
        if($this->country == "")
        {
            $this->error = "choose a country first";
            return;
        }
        try {
            //code...
            Form::create(['country' => $this->country]);
            $this->error = "";
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            if($th->errorInfo[0]==23505)
            {
                $this->error = "Form for this country already exists";
            }else{
                $this->error = "Error Occured try again later";
            }
            // dd($th->errorInfo);
        }
        
    }

    public function delete(Form $form)
    {
        $form->delete();
    }
    
    public function with()
    {
        return ['forms' => Form::latest()->get()];
    }
}; ?>

<div class="p-4">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Forms') }}
        </h2>
    </x-slot>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <h1>Choose the country and Create a new Form</h1>
    <form>
        <select name="country" wire:model='country'>
            <option selected>Choose a Country</option>
            <option value="Algeria">Algeria</option>
            <option value="Brazil">Brazil</option>
            <option value="Canada">Canada</option>
            <option value="Denmark">Denmark</option>
        </select>
        <button wire:click.prevent="create" class="p-2 rounded-md hover:bg-cyan-400 bg-cyan-300">Create</button>
        <p class="text-sm text-red-600">{{$error}}</p>
    </form>

    <div class="flex">
        <ul>forms-editor
            @foreach ($forms as $form )
                <li wire:key="{{$form->id}}" class="flex justify-between p-2 hover:bg-slate-400 "> 
                    <a class="p-1" href="/forms-editor/{{$form->id}}">
                    {{ $form->country }}
                    <button class="p-1 bg-orange-500 rounded-md ">Edit</button>
                </a> 
                <button class="p-1 bg-red-500 rounded-md " wire:click="delete({{$form}})">Delete</button>
             </li>
            @endforeach
        </ul>
    </div>
</div>
