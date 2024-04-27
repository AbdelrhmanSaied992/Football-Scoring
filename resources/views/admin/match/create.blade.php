@extends('admin.layouts.form')
@section('section', __('Matches'))
@section('title', __('Create Match'))
@section('container', 'container-max-lg')
@section('back', route('admin.matches.index'))
@section('content')

    <form id="vironeer-submited-form" action="{{ route('admin.matches.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ __('Match Details') }}
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">{{ __('Tournament') }} : <span class="red">*</span></label>
                    <select class="form-control select2" name="tournament_id" required>
                        @foreach ($tournaments as $tournament)
                            <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('First Team') }} : <span class="red">*</span></label>
                            <select class="form-control select2" name="first_team" required>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Second Name') }} : <span class="red">*</span></label>
                            <select class="form-control select2" name="second_team" required>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label">{{ __('Date') }} : <span class="red">*</span></label>
                    <input type="datetime-local" name="date" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Stadium') }} : <span class="red">*</span></label>
                    <input type="text" name="venue" class="form-control form-control-lg" required>
                </div>


            </div>
        </div>



    </form>




@endsection


