@extends('layouts.app')

@section('page', 'List')
@section('group', 'User')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="text-right mb-2">
                    <a href="{{ route('user.index', ['upcoming_birthday' => 1]) }}"
                        class="btn btn-primary waves-effect w-md waves-light m-b-5">Upcoming Birthday</a>
                    <a href="{{ route('user.index', ['recent_birthday' => 1]) }}"
                        class="btn btn-primary waves-effect w-md waves-light m-b-5">Recent Birthday</a>
                    <a href="{{ route('user.index') }}" class="btn btn-success waves-effect w-md waves-light m-b-5"> <i
                            class="fas fa-list"></i> All Users</a>
                    <a href="{{ route('user.create') }}" class="btn btn-success waves-effect w-md waves-light m-b-5"> <i
                            class="fas fa-plus"></i> Add</a>
                </div>
                <table class="table table-striped table-bordered dt-responsive nowrap data-table"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>DOB</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $key => $value)
                            <tr>
                                <td class="sno">{{ $key + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->address }}</td>
                                <td>{{ $value->dob }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $value->id) }}"
                                        class="btn btn-icon waves-effect btn-warning m-b-5"> <i class="fas fa-pen"></i> </a>
                                    <button type="button" class="btn btn-icon waves-effect btn-danger m-b-5 delete"
                                        data-id="{{ $value->id }}"
                                        data-api-url="{{ route('api.user.destroy', $value->id) }}" data-web-url="{{ route('user.destroy', $value->id) }}"> <i
                                            class="fas fa-times"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
