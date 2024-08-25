<x-app-layout>
    
    <div class="grid gap-2 grid-rows">
        <div class="">

            <h2>Form customizer</h2>
        </div>
        <form>

            <div class="">

                <input type="text" wire:model='name' placeholder="Field Name">
                <select wire:model='type' wire:change='dosomething'>
                    <option value="text">text</option>
                    <option value="date">date</option>
                    <option value="dropdown">dropdown</option>
                    <option value="checkbox">checkbox</option>
                    <option value="file">file</option>
                </select>
                <select wire:model='category'>
                    <option value="General Information">General Information</option>
                    <option value="Identity">Identity</option>
                    <option value="Band Related">Bank Related</option>
                </select>
                <label>
                    is Required ?
                    <input type="checkbox" wire:model='required'>
                </label>
                <button type="submit" class="p-2 rounded-md hover:bg-cyan-500 bg-cyan-400"
                    wire:click.prevent="testing">Save</button>
            </div>
            <div class="my-2">
                @if ($type == 'dropdown')
                    <div class="flex flex-col gap-2">
                        <div>
                            <button type="button" class="p-2 rounded-md hover:bg-cyan-500 bg-cyan-400"
                                wire:click="increment">add option</button>
                        </div>
                        @foreach ($options as $option)
                            <d
                            dd($form);iv>
                                <input type="text" name="option" wire:model='$option' placeholder="option"
                                    id="">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </form>
        {{-- the next element is for testing purposes only, to be removed later --}}
        {{-- <livewire:form-element :formItem="$item"> --}}
    </div>
</x-app-layout>
