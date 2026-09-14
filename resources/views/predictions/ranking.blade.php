<x-layouts::app :title="__('Ranking Global')">
    <div class="max-w-4xl mx-auto flex flex-col gap-5 w-full flex-1 text-zinc-100 font-sans">
        
        <div class="shadow-sm flex flex-col items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-white tracking-wide uppercase font-mono">Salón de la Fama - PyroBet</h2>
            </div>

        <div class="w-full bg-slate-950 border border-emerald-400 rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-emerald-400 bg-gradient-to-bl from-lime-300 to-emerald-400 text-[10px] uppercase font-extrabold text-white tracking-widest">
                            <th class="py-3 px-5">Puesto</th>
                            <th class="py-3 px-4">Usuario / Jugador</th>
                            <th class="py-3 px-5">Puntos Totales</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-400 text-xs text-white font-medium">
                        @forelse($users as $index => $user)
                            @php
                                $position = $index + 1;
                            @endphp

                            <tr class="{{ auth()->id() === $user->id ? 'bg-slate-950 border-y border-emerald-400' : '' }}">
                                
                                 <td class="py-3.5 px-5 text-center font-mono font-black">
                                    @if($position === 1)
                                        <span class="inline-flex items-center justify-center size-6 bg-amber-400/10 text-amber-400 border border-amber-400/30 rounded-full text-xs">1</span>
                                    @elseif($position === 2)
                                        <span class="inline-flex items-center justify-center size-6 bg-zinc-300/10 text-zinc-300 border border-zinc-300/30 rounded-full text-xs">2</span>
                                    @elseif($position === 3)
                                        <span class="inline-flex items-center justify-center size-6 bg-amber-700/10 text-amber-600 border border-amber-700/30 rounded-full text-xs">3</span>
                                    @else
                                        <span class="text-zinc-500 font-bold">#{{ $position }}</span>
                                    @endif
                                </td>

                                <td class="py-3.5 px-4 font-bold text-white flex justify-center items-center gap-2">
                                    <span class="uppercase tracking-wide">{{ $user->name }}</span>
                                    @if(auth()->id() === $user->id)
                                        <span class="text-[9px] font-black font-mono text-emerald-400 bg-emerald-950/40 border border-emerald-900/40 px-1.5 py-0.5 rounded uppercase">Tú</span>
                                    @endif
                                </td>

                                <td class="font-mono font-black text-center text-sm text-emerald-400">
                                    {{ $user->total_points ?? 0 }} <span class="text-[9px] font-bold text-white uppercase font-sans">PTS</span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-white font-medium border-dashed border border-emerald-400 rounded-b-xl">
                                    No hay registros de puntuación disponibles en la base de datos de SQLite.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts::app>