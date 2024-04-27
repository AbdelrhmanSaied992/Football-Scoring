@extends('admin.layouts.application')
@section('title', __('Teams'))
@section('link', route('admin.teams.create'))
@section('content')
    <div class="card custom-card">
        <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="monthly-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Name') }}</th>
                            <th class="tb-w-3x">{{ __('Logo') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $key => $team)
                            <tr class="item">
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    {{ ucfirst($team->name) }}
                                </td>

                                <td>

                                    <div class="avatar mb-3">
                                        <img src="{{ asset($team->image) }}" class="rounded-circle border" width="50"
                                             height="50">
                                    </div>

                                </td>


                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">

                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.teams.edit', $team->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>

                                            <li>
                                                <form action="{{ route('admin.teams.destroy', $team->id) }}"
                                                      method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="vironeer-able-to-delete dropdown-item text-danger"><i
                                                            class="far fa-trash-alt me-2"></i>{{ __('Delete') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
