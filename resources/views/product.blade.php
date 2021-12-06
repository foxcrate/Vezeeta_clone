@extends('backEnd.layoutes.mastar')
@section('content')
    <table class="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>price</th>
            <th>currency</th>
            <th>price for pound</th>
            <th>price for riyal</th>
        </tr>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>@if($p->currency == 'doller') $ @elseif($p->currency == 'pound') LE @endif{{ $p->price }}</td>
                <td>{{ $p->currency }}</td>
                <td>
                    @if($p->currency== 'pound')
                        {{ $p->currency }}
                    @elseif($p->currency == 'doller')
                        {{ $p->price * 15 }} LE
                    @elseif($p->currency == 'riyal')
                        {{ $p->currency * 5 }} LE
                    @endif
                </td>
                <td>
                    @if($p->currency == 'riyal')
                        {{ $p->currency }}
                    @elseif($p->currency == 'doller')
                        {{ $p->price * 3.75 }} RS
                    @elseif($p->currency == 'pound')
                        {{ $p->currency * 0.24 }} RS
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <script src="{{url('js/jquery-3.4.1.js')}}"></script>
@stop
