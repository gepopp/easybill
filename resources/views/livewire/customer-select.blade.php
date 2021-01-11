<div>
    <div class="relative" x-data="{ highlight : 0, search_results : {{ $search_result_json }} }">
        <input type="search"
               id="customer_name"
               class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-left focus:outline-none"
               placeholder="Kunde suchen"
               wire:model="search"
               x-on:keydown.arrow-down="highlight = Math.min(search_results.length - 1, highlight + 1);"
               x-on:keydown.arrow-up="highlight = Math.max( 0, highlight - 1);"
               x-on:keydown.enter="
                       $wire.fillIn(highlight);
                   "/>

        <div class="absolute top-0 left-0 mt-16 p-5 shadow-lg bg-white w-full z-50 rounded-xl" x-show="search_results.length > 0">
            <ul>
                <template x-for="(item, index) in search_results" x-key="item.id">
                    <li class="py-3 hover:bg-gray-50 cursor-pointer list-none border-b"
                        :class="{'bg-gray-50': index == highlight }"
                        x-on:click="
                            $wire.fillIn(index)
                        ">
                        <p class="text-sm font-bold" x-text="item.company_name"></p>
                        <p class="text-sm font-bold">
                            <span x-text="item.first_name"></span>
                            <span x-text="item.last_name"></span>
                        </p>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
