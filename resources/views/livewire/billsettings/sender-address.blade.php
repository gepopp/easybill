<x-jet-form-section submit="updateSettings">
    <x-slot name="title">
        {{ __('Rechnungs Informationen') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Lege hier die statischen Informationen deiner Rechnungen an.') }}
        {{--        <pre class="max-w-full">--}}
        {{--            <code>--}}
        {{--                {!! print_r($settings['logo']) !!}--}}
        {{--            </code>--}}
        {{--        </pre>--}}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-6">

            <div class="mt-2" x-show="upload">
                @if($settings['logo'])
                    @if(!is_string($settings['logo']))
                        <img src="{{ $settings['logo']->temporaryUrl() }}"/>
                    @endif

                    @if(is_string($settings['logo']))
                        <img src="{{ Storage::temporaryUrl($settings['logo'], now()->addMinutes(3)) }}" class="object-cover">
                    @endif
                @endif
            </div>


            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="logo" value="{{ __('Logo') }}"/>
                <input type="file" wire:model="settings.logo" x-on:change="upload = true"/>
                <x-jet-input-error for="settings.logo" class="mt-2"/>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="company_name" value="{{ __('Firmenbezeichnung') }}"/>
            <x-jet-input id="company_name" type="text" class="mt-1 block w-full" wire:model.defer="settings.company_name"/>
            <x-jet-input-error for="settings.company_name" class="mt-2"/>
        </div>
        <!-- Name -->
        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="address" value="{{ __('Absendezeile im Adressfenster') }}"/>
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="settings.address"/>
            <x-jet-input-error for="settings.address" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="contactperson" value="{{ __('Ansprechperson') }}"/>
            <x-jet-input id="contactperson" type="text" class="mt-1 block w-full" wire:model.defer="settings.contactperson"/>
            <x-jet-input-error for="settings.contactperson" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="contactemail" value="{{ __('Kontakt E-Mail') }}"/>
            <x-jet-input id="contactemail" type="email" class="mt-1 block w-full" wire:model.defer="settings.contactemail"/>
            <x-jet-input-error for="settings.contactemail" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="contactphone" value="{{ __('Kontakt Telefon') }}"/>
            <x-jet-input id="contactphone" type="text" class="mt-1 block w-full" wire:model.defer="settings.contactphone"/>
            <x-jet-input-error for="settings.contactphone" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="desired_respite" value="{{ __('Standard Zahlungsziel') }}"/>
            <x-jet-input id="desired_respite" type="text" class="mt-1 block w-full" wire:model.defer="settings.desired_respite"/>
            <x-jet-input-error for="settings.desired_respite" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="prefix" value="{{ __('Rechnungsnummer Prefix') }}"/>
            <x-jet-input id="prefix" type="text" class="mt-1 block w-full" wire:model.defer="settings.prefix"/>
            <x-jet-input-error for="settings.prefix" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="bill_number" value="{{ __('Rechnungsnummer Beginnt bei') }}"/>
            <x-jet-input id="bill_number" type="number" step="1" class="mt-1 block w-full" wire:model.defer="settings.bill_number"/>
            <x-jet-input-error for="settings.bill_number" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="uid" value="{{ __('UID') }}"/>
            <x-jet-input id="uid" type="text" class="mt-1 block w-full" wire:model.defer="settings.uid"/>
            <x-jet-input-error for="settings.uid" class="mt-2"/>
        </div>


        @push('styles')
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        @endpush

        @push('scripts')
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        @endpush

        <div class="my-16 bg-white col-span-6" wire:ignore>
            <x-jet-label for="headertext" value="{{ __('Kopftext') }}"/>
            <div x-data x-ref="headertext"
                 x-init="
                 quill_headertext = new Quill($refs.headertext, {theme: 'snow'});
                 quill_headertext.on('text-change', function () {
                    $wire.updatewysiwyg(quill_headertext.root.innerHTML, 'headertext');
                 });
                ">
                {!! $settings['headertext'] !!}
            </div>
        </div>

        <div class="my-16 bg-white col-span-6" wire:ignore>
            <x-jet-label for="footertext" value="{{ __('Fussnote') }}"/>
            <div x-data x-ref="footertext"
                 x-init="
                 quill_footertext = new Quill($refs.footertext, {theme: 'snow'});
                 quill_footertext.on('text-change', function () {
                    $wire.updatewysiwyg(quill_footertext.root.innerHTML, 'footertext');
                 });
                ">
                {!! $settings['footertext'] !!}
            </div>
        </div>


        <div class="my-16 bg-white col-span-6" wire:ignore>
            <x-jet-label for="footercol_1" value="{{ __('Fusszeile Spalte links') }}"/>
            <div x-data x-ref="footercol_1"
                 x-init="
                 quill_footercol_1 = new Quill($refs.footercol_1, {theme: 'snow'});
                 quill_footercol_1.on('text-change', function () {
                    $wire.updatewysiwyg(quill_footercol_1.root.innerHTML, 'footercol_1');
                 });
                ">
                {!! $settings['footercol_1'] !!}
            </div>
        </div>

        <div class="my-16 bg-white col-span-6" wire:ignore>
            <x-jet-label for="footercol_2" value="{{ __('Fusszeile Spalte mitte') }}"/>
            <div x-data x-ref="footercol_2"
                 x-init="
                 quill_footercol_2 = new Quill($refs.footercol_2, {theme: 'snow'});
                 quill_footercol_2.on('text-change', function () {
                    $wire.updatewysiwyg(quill_footercol_2.root.innerHTML, 'footercol_2');
                 });
                ">
                {!! $settings['footercol_2'] !!}
            </div>
        </div>

        <div class="my-16 bg-white col-span-6" wire:ignore>
            <x-jet-label for="footercol_3" value="{{ __('Fusszeile Spalte rechts') }}"/>
            <div x-data x-ref="footercol_3"
                 x-init="
                 quill_footercol_3 = new Quill($refs.footercol_3, {theme: 'snow'});
                 quill_footercol_3.on('text-change', function () {
                    $wire.updatewysiwyg(quill_footercol_3.root.innerHTML, 'footercol_3');
                 });
                ">
                {!! $settings['footercol_3'] !!}
            </div>
        </div>


    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
