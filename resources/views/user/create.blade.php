@extends('layouts.app')

@section('page', 'Add')
@section('group', 'User')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="text-right">
                    <a href="{{ route('user.index') }}" class="btn btn-success waves-effect w-md waves-light m-b-5"> <i
                            class="mdi mdi-format-list-bulleted"></i> Lists</a>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-t-20">
                        <form method="post" action="{{ route('user.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="dob" name="dob"
                                        placeholder="yyyy-mm-dd" value="{{ old('dob') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-custom text-white b-0"><i
                                                class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                <a href="{{ route('user.index') }}"
                                    class="btn btn-danger waves-effect waves-light">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        })
    </script>
@endpush
