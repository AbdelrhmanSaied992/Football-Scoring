@extends('admin.layouts.form')
@section('section', __('Tournament'))
@section('title', __('Create Tournament'))
@section('container', 'container-max-lg')
@section('back', route('admin.tournaments.index'))
@section('content')

    <form id="vironeer-submited-form" action="{{ route('admin.tournaments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ __('Tournament Details') }}
            </div>

            <div class="card-body">

                <div class="avatar text-center py-4">
                    <img id="filePreview" class="rounded-circle mb-3" width="120px"
                         height="120px">
                    <button id="selectFileBtn" type="button"
                            class="btn btn-secondary d-flex m-auto">{{ __('Choose Image') }}</button>
                    <input id="selectedFileInput" type="file" name="avatar" accept="image/png, image/jpg, image/jpeg"
                           hidden>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="text" name="name" class="form-control form-control-lg" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">{{ __('Format') }} : <span class="red">*</span></label>
                    <select class="form-control form-control-lg select2" name="format" required>
                        <option value="knockout">{{ __('Knockout') }}</option>
                        <option value="round-robin">{{ __('Round-Robin') }}</option>
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
                <div id="inputs-container">
                    <div class="input-group mb-3">
                        <select class="form-control select2" name="teams[]" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-danger delete-btn" type="button">Delete</button>
                        </div>
                    </div>
                </div>

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


