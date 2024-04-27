@extends('admin.layouts.form')
@section('section', __('Matches'))
@section('title', __('Update Match'))
@section('container', 'container-max-lg')
@section('back', route('admin.matches.index'))
@section('content')

    <form id="vironeer-submited-form" action="{{ route('admin.matches.update',$match->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ __('Team Details') }}
            </div>

            <div class="card-body">
                <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('First Team') }} : <span class="red">*</span></label>
                        <select class="form-control select2" name="first_team" disabled required>
                            @foreach ($teams as $team)
                                <option @if($match->matchResults[0]->team_id == $team->id) selected @endif value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Second Name') }} : <span class="red">*</span></label>
                        <select class="form-control select2" name="second_team" disabled required>
                            @foreach ($teams as $team)
                                <option @if($match->matchResults[1]->team_id == $team->id) selected @endif value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('First Team Score') }} : <span class="red">*</span></label>
                        <input type="number" min="0" max="100" value="{{$match->matchResults[0]->score}}" name="score_first_team" class="form-control form-control-lg" required>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Second Name Score') }} : <span class="red">*</span></label>
                        <input type="number" min="0" max="100" value="{{$match->matchResults[1]->score}}" name="score_second_team" class="form-control form-control-lg" required>
                    </div>
                </div>
            </div>



            <div class="mb-3">
                <label class="form-label">{{ __('Stadium') }} : <span class="red">*</span></label>
                <input type="text" value="{{$match->venue}}" name="venue" class="form-control form-control-lg" required>
            </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Match Status') }} : <span class="red">*</span></label>
                    <select class="form-control select2" name="status" required>
                        <option @if($match->status == '0') selected @endif value="0">{{ __('Pending') }}</option>
                        <option @if($match->status == '1') selected @endif value="1">{{ __('Started') }}</option>
                        <option @if($match->status == '2') selected @endif value="2">{{ __('Finished') }}</option>
                    </select>
                </div>

            </div>
        </div>

    </form>


@endsection


