<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Produkt bearbeiten') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <button onclick="document.getElementById('product-form').submit()" class="button-secondary">speichern</button>
    </x-slot>


    <div class="py-12">
        <div class="max-w-screen-xl mx-auto px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <form action="{{ route('products.update', $product) }}" class="w-full" method="post" id="product-form">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <x-input label="Prduktbezeichnung" name="name" value="{{ old('name') ?? $product->name }}"></x-input>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input label="Nettopreis"
                                     type="number"
                                     name="netto"
                                     value="{{ old('netto') ?? $product->netto }}"
                                     pattern="[0-9]+([,\.][0-9]+)?"
                                     step="0.01"></x-input>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input label="Einheit" name="unit" value="{{ old('unit') ?? $product->unit }}"></x-input>
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <x-input label="MwSt. Satz" type="number" name="vat" pattern="[0-9]+([,\.][0-9]+)?" step="0.01" value="{{ old('vat') ?? $product->vat }}"></x-input>
                        </div>
                    </div>

                    @push('styles')
                        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                    @endpush

                    @push('scripts')
                        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    @endpush


                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <x-jet-label for="headertext" value="{{ __('Beschreibung') }}"/>
                            <div id="productdescription">
                                {!! old('description') ?? $product->description !!}
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="description" id="description">
                    <script>
                        window.onload = function (){
                            var editor = new Quill('#productdescription',
                                {
                                    modules: {
                                        toolbar: [
                                            [{ header: [1, 2, false] }],
                                            ['bold', 'italic', 'underline'],
                                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                        ]
                                    },
                                    placeholder: '',
                                    theme: 'snow'  // or 'bubble'
                                });

                            editor.on('text-change', function(delta, oldDelta, source) {
                                document.getElementById('description').value = editor.container.firstChild.innerHTML;
                            });
                        }
                    </script>
                    <style>
                        #productdescription {
                            height: 375px;
                        }
                    </style>
                </form>
            </div>
        </div>
    </div>
</x-vertical-layout>


