<div
    class="w-full md:max-w-[400px] py-2 flex  flex-row justify-between items-center border-2 border-gray-700 bg-gray-800 shadow-xl shadow-gray-800/100 rounded-xl">
    {{-- team 1 --}}
    <x-schedule.team team="{{ $teamA }}" logo="{{ $logoA }}" />
    {{-- time --}}
    <x-schedule.time time="{{ $time }}" date="{{ $date }}" score-a="{{ $scoreA }}"
        score-b="{{ $scoreB }}" />
    {{-- team 2 --}}
    <x-schedule.team team="{{ $teamB }}" logo="{{ $logoB }}" />
    {{-- end of one match --}}
</div>
