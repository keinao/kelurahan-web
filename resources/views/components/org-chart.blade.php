@props(['struktur'])

<div class="kn-org-chart" role="group" aria-label="Bagan hierarki perangkat kelurahan">
    <ol class="kn-org-chart__tree">
        <li class="kn-org-chart__root">
            <x-official-card :person="$struktur['lurah']" />
            @if(!empty($struktur['sekretaris']))
                <x-official-card :person="$struktur['sekretaris']" />
            @endif
            <ol class="kn-org-chart__branches" aria-label="Seksi dan perangkat pelaksana">
                @foreach($struktur['seksi'] as $seksi)
                    <li class="kn-org-chart__branch">
                        <x-official-card :person="$seksi['kepala']" />
                        @if(count($seksi['operator']))
                            <ol class="kn-org-chart__operators" aria-label="Operator pada seksi ini">
                                @foreach($seksi['operator'] as $operator)
                                    <li><x-official-card :person="$operator" /></li>
                                @endforeach
                            </ol>
                        @endif
                    </li>
                @endforeach
            </ol>
        </li>
    </ol>
</div>
