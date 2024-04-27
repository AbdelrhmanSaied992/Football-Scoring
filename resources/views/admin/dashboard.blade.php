@extends('admin.layouts.application')
@section('title', __('Dashboard'))
@section('content')
    <style>
        .filter-form {
            display: flex;
            align-items: center;
        }

        .filter-form input[type="date"] {
            margin-right: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .filter-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .filter-form button:hover {
            background-color: #0056b3;
        }

        .live-score-ticker {
            overflow: hidden;
        }

        .ticker-container {
            display: flex;
            animation: ticker-scroll 20s linear infinite;
        }

        .ticker-item {
            min-width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-right: 10px;
        }

        .live-score-ticker {
            overflow: hidden;
            white-space: nowrap;
        }

        .live-score-ticker .ticker-container {
            display: flex;
            flex-direction: row-reverse; /* Start from right and move towards left */
            animation: ticker-slide 10s linear infinite; /* Example animation */
        }

        .live-score-ticker .ticker-item {
            font-size: 14px; /* Reduce font size */
            padding: 5px 10px; /* Adjust padding */
            margin-left: 10px; /* Adjust margins between items */
        }

        @keyframes ticker-slide {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }


        .team-logo {
            max-width: 100px;
        }
        .score {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 0;
        }
        .score-divider {
            border-right: 2px solid #007bff;
            height: 100px;
        }
        .match-details p {
            margin-bottom: 5px;
        }
        .live-updates {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 5px;
            height: 200px;
            overflow-y: auto;
        }
        .live-updates p {
            margin-bottom: 10px;
        }


    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="live-score-ticker">
                    <div class="ticker-container" style="width: 50%">
                        @foreach($matches as $match)
                            @if($match->status == '0')
                                <div class="ticker-item">
                                    {{ $match->matchResults[0]->team->name }} VS {{ $match->matchResults[1]->team->name }}
                                </div>
                            @else
                                <div class="ticker-item">
                                    {{ $match->matchResults[0]->team->name }} {{ $match->matchResults[0]->score }} - {{ $match->matchResults[1]->score }} {{ $match->matchResults[1]->team->name }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($matches as $match)


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mb-4">Football Match</h1>
                    <div class="row">
                        <div class="col-md-5 text-center">
                            <img src="{{ asset($match->matchResults[1]->team->image) }}" alt="Team 1 Logo" class="team-logo">
                            <h2 class="mt-3">{{$match->matchResults[0]->team->name}}</h2>
                        </div>
                        <div class="col-md-2 d-flex align-items-center justify-content-center">

                            @if($match->status == '0')
                                <h2 class="score">VS</h2>

                            @else
                                <h2 class="score">{{ $match->matchResults[0]->score }} - {{ $match->matchResults[1]->score }}</h2>

                            @endif




                        </div>
                        <div class="col-md-5 text-center">
                            <img src="{{ asset($match->matchResults[1]->team->image) }}" alt="Team 2 Logo" class="team-logo">
                            <h2 class="mt-3">{{$match->matchResults[1]->team->name}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 match-details text-center">
                    <p>Date: {{$match->date}}</p>
                    <p>Time: {{$match->time}}</p>
                    <p>Stadium: {{$match->venue}}</p>
                </div>
            </div>
        </div>
        <hr>
    @endforeach


    @foreach($AllTournaments as $tournament)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{$tournament['tournament']['name']}} Leaderboard</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{__('Team')}}</th>
                                        <th class="text-center">{{__('Points')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tournament['result'] as $index => $result)
                                        <tr>
                                            <td class="text-center">{{$index+1}}</td>
                                            <td class="text-center">{{$result['team']['name']}}</td>
                                            <td class="text-center">{{$result['points']}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach







    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/chartjs/chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/admin/js/charts.js') }}"></script>
    @endpush
@endsection
