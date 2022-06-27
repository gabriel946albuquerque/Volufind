@extends('layouts.main')

@section('title', 'Volufind')

@section('content')
    
    <div id="search-container" class="col-md-12 mb-5">
        <h1 class="mt-5">Busque um evento</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Título do evento">
        </form>
    </div>

    <div id="events-container" class="col-md-12 mb-3">
        @if($search)
            <h2>Resultados da busca: {{$search}}</h2>
        @else
            <h2>Próximos Eventos</h2>
            <p class="subtitle">Veja os eventos dos próximos dias</p>
        @endif
        
        <div id="cards-container" class="row">
            @if (count($events) == 0 && $search)
                <h4>Não foi possível encontrar eventos com {{ $search }}!</h4>
            @elseif(count($events) == 0)
                <h4>Não há eventos disponíveis!</h4>
            @else
                @foreach($events as $event)
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                            <div class="card-body text-center">
                                <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="event-city"><ion-icon name="location-outline"></ion-icon>{{$event->city}}</p>
                                <p class="events-participants"><ion-icon name="people-outline"></ion-icon>@if(count($event->users) == 0) Nenhum participante @elseif(count($event->users) == 1) {{ count($event->users) }} participante @else {{ count($event->users) }} participantes @endif</p>
                                <a href="/events/{{ $event->id }}" class="btn btn-primary btn-block">Saber mais</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection