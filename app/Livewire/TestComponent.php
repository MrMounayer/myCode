<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Form;

class TestComponent extends Component
{
    public $name = '';
    public $type = '';
    public $required = false;
    public $category = '';
    public $options = null;

    public $form = null;

    // simulating a field record
    public $item = ['name' => 'somename', 'id' => 'someid', 'type' => 'date', 'options' => ['first', 'second', 'third']];

    public function increment()
    {
        array_push($this->options, '');
    }

    private function clear()
    {
        $this->name = '';
        $this->type = '';
        $this->required = false;
        $this->category = '';
        $this->options = null;
    }

    public function saveField(Form $form)
    {
        $form->fields()->create(['name' => 'arbitrary']);

        $this->clear();
        return [];
    }

    public function testing()
    {
        dd($this->form);
    }
    
    public function mount(Form $form)
    {
        $this->form = $form;
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

    public function decrement()
    {
        array_pop($this->fields);
    }
    //
    public function render()
    {
        return view('livewire.test-component');
    }
}
