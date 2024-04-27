@extends('admin.layouts.form')
@section('section', __('Teams'))
@section('title', __('Update Team'))
@section('container', 'container-max-lg')
@section('back', route('admin.teams.index'))
@section('content')

    <form id="vironeer-submited-form" action="{{ route('admin.teams.update',$team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ __('Team Details') }}
            </div>

            <div class="card-body">

                <div class="avatar text-center py-4">
                    <img src="{{ asset($team->image) }}" id="filePreview" class="rounded-circle mb-3" width="120px"
                         height="120px">
                    <button id="selectFileBtn" type="button"
                            class="btn btn-secondary d-flex m-auto">{{ __('Choose Image') }}</button>
                    <input id="selectedFileInput" type="file" name="avatar" accept="image/png, image/jpg, image/jpeg"
                           hidden>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Team Name') }} : <span class="red">*</span></label>
                    <input type="name" value="{{$team->name}}" name="team_name" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Administrative Name') }} : <span class="red">*</span></label>
                    <input type="name" value="{{$team->TeamAdministrative->name}}" name="administrative_name" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('E-mail Address') }} : <span class="red">*</span></label>
                    <input type="email" value="{{$team->TeamAdministrative->email}}" name="email" class="form-control form-control-lg" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">{{ __('Password') }} : <span class="red">*</span></label>
                    <input type="password" name="password" class="form-control form-control-lg"
                           >
                </div>
            </div>
        </div>

        <br>

        <div class="card m-b">
            <div class="card-header bg-primary text-white">
                {{ __('Players Details') }}
            </div>
            <div class="card-body">
                @foreach($team->players as $player)

                    <div id="inputs-container">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="players[]" placeholder="Enter Player Name" value="{{$player->name}}">
                            <div class="input-group-append">
                                <button class="btn btn-danger delete-btn" type="button">Delete</button>
                            </div>
                        </div>
                    </div>

                @endforeach


                <input id="add-input" class="btn btn-primary" value="Add Player">


            </div>
        </div>


    </form>



    @push('scripts')
        <script>
            $(document).ready(function() {
                // Add input
                $('#add-input').on('click', function() {
                    var newInput = '<div class="input-group mb-3">' +
                        '<input type="text" class="form-control" name="players[]" placeholder="Enter Player Name">' +
                        '<div class="input-group-append">' +
                        '<button class="btn btn-danger delete-btn" type="button">Delete</button>' +
                        '</div>' +
                        '</div>';
                    $('#inputs-container').append(newInput);
                });

                // Delete input
                $(document).on('click', '.delete-btn', function() {
                    $(this).closest('.input-group').remove();
                });
            });
        </script>
    @endpush

@endsection


