<x-app-layout>
    <div class="py-20 ">

        <div class="mx-auto max-w-7xl relative">
            <div class="flex">
                <x-shared.sidebar />
                <div class="flex-1">
                    <header class="px-10 text-xl font-bold text-gray-600">MY ACCOUNT</header>
                    <div class="py-5 px-10">
                        <div class="bg-white p-10 rounded-lg">
                            <livewire:patient.patient-account />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
