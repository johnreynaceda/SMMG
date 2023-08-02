<div>
    <div class="bg-white rounded-xl p-5">
        <header>
            <h1 class="text-xl font-bold text-gray-700 ">List of Patients</h1>
            <p class="text-gray-500">{{ $patients_count }} patient(s)</p>
        </header>
        <div class="mt-3">
            {{ $this->table }}
        </div>
    </div>
</div>
