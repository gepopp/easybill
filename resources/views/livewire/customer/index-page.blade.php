<div class="grid grid-cols-6 gap-10 h-full -m-5">
    <div class="col-span-2 p-8">
        <div class="pb-5 border-b border-logo-primary">
            <input
                type="text"
                class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
            >
        </div>
        <div class="flex flex-col bg-logo-gray h-64">
            <ul class="py-5">
                @forelse($customers as $customer)
                    <li class="p-3 border-b border-logo-primary bg-white">
                        <p class="text-sm font-semibold">{{ $customer->company_name }}</p>
                    </li>
                @empty
                    <li style="height: 500px"></li>
                @endforelse
            </ul>

        </div>
    </div>
    <div class="col-span-4 flex items-center justify-center bg-gray-800 py-8"></div>
</div>
