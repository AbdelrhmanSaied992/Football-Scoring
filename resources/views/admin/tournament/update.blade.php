@extends('admin.layouts.form')
@section('section', __('Tournaments'))
@section('title', __('Update Team'))
@section('container', 'container-max-lg')
@section('back', route('admin.tournaments.index'))
@section('content')

    <form id="vironeer-submited-form" action="{{ route('admin.tournaments.update',$tournament->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ __('Team Details') }}
            </div>

            <div class="card-body">

                <div class="avatar text-center py-4">
                    <img src="{{ asset($tournament->logo) }}" id="filePreview" class="rounded-circle mb-3" width="120px"
                         height="120px">
                    <button id="selectFileBtn" type="button"
                            class="btn btn-secondary d-flex m-auto">{{ __('Choose Image') }}</button>
                    <input id="selectedFileInput" type="file" name="avatar" accept="image/png, image/jpg, image/jpeg"
                           hidden>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="name" value="{{$tournament->name}}" name="name" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Format') }} : <span class="red">*</span></label>
                    <select class="form-control form-control-lg select2" name="format" required disabled>
                        <option @if($tournament->format == 'knockout')selected @endif value="knockout">{{ __('Knockout') }}</option>
                        <option @if($tournament->format == 'round-robin')selected @endif value="round-robin">{{ __('Round-Robin') }}</option>
                    </select>

                </div>

            </div>
        </div>

        <br>

        <div class="card m-b">
            <div class="card-header bg-primary text-white">
                {{ __('Teams Details') }}
            </div>
            <div class="card-body">

                @foreach($selectedTeamsID as $teamID)

                    <div id="inputs-container">
                        <div class="input-group mb-3">
                            <select class="form-control select2" name="teams[]" required>
                                @foreach ($teams as $team)
                                    <option @if($team->id == $teamID) selected @endif value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger delete-btn" type="button">Delete</button>
                            </div>
                        </div>
                    </div>

                @endforeach




                <input id="add-input" class="btn btn-primary" value="Add Team">


            </div>
        </div>


    </form>



    @push('scripts')
        <script>
            $(document).ready(function() {
                // Add input
                $('#add-input').on('click', function() {
                    var newInput = '<div class="input-group mb-3">' +
                        '<select class="form-control select2" name="teams[]">';
                    @foreach ($teams as $team)
                        newInput += '<option value="{{ $team->id }}">{{ $team->name }}</option>';
                    @endforeach

                        newInput += '</select>' +
                        '<div class="input-group-append">' +
                        '<button class="btn btn-danger delete-btn" type="button">Delete</button>' +
                        '</div>' +
                        '</div>';

                    $('#inputs-container').append(newInput);

                    // Reinitialize Select2 for the new elements
                    $('.select2').select2();
                });

                // Delete input
                $(document).on('click', '.delete-btn', function() {
                    $(this).closest('.input-group').remove();
                });
            });
        </script>
    @endpush

@endsection


