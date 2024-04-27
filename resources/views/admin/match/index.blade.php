@extends('admin.layouts.application')
@section('title', __('Matches'))
@section('link', route('admin.matches.create'))
@section('content')
    <div class="card custom-card">
        <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="monthly-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Tournament') }}</th>
                            <th class="tb-w-3x">{{ __('Teams') }}</th>
                            <th class="tb-w-3x">{{ __('Date') }}</th>
                            <th class="tb-w-3x">{{ __('Result') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matches as $key => $match)
                            <tr class="item">
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    {{ $match->tournament->name }}
                                </td>

                                <td>
                                    {{ $match->matchResults[0]->team->name }} VS {{ $match->matchResults[1]->team->name }}
                                </td>
                                <td>
                                    {{ $match->date }} - {{ $match->time }}
                                </td>

                                <td>
                                    {{ $match->matchResults[0]->score }} - {{ $match->matchResults[1]->score}}
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
                                                   href="{{ route('admin.matches.edit', $match->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>

                                            <li>
                                                <form action="{{ route('admin.matches.destroy', $match->id) }}"
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
