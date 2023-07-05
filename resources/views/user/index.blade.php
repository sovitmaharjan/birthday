@extends('layouts.app')

@section('page', 'List')
@section('group', 'User')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="text-right mb-2">
                    <a href="{{ route('user.index', ['upcoming_birthday' => 1]) }}" class="btn btn-primary waves-effect w-md waves-light m-b-5">Upcoming Birthday</a>
                    <a href="{{ route('user.index', ['recent_birthday' => 1]) }}" class="btn btn-primary waves-effect w-md waves-light m-b-5">Recent Birthday</a>
                    <a href="{{ route('user.create') }}" class="btn btn-success waves-effect w-md waves-light m-b-5"> <i
                            class="fas fa-plus"></i> Add</a>
                </div>
                <table id="user_table" class="table table-striped table-bordered dt-responsive nowrap"
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
                                        data-id="{{ $value->id }}"> <i class="fas fa-times"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var table = $('#user_table').DataTable();

        $(document).on('click', '.delete', function() {
            var row = $(this).closest('tr');
            var id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{ route('api.user.destroy', ':id') }}";
                    url = url.replace(":id", id);
                    $.ajax({
                        type: 'POST',
                        data: {
                            '_method': 'delete'
                        },
                        url: url,
                        success: function() {
                            table.row(row).remove().draw();
                            var rows = table.rows().nodes();
                            rows.each(function(i, e) {
                                $(e).find('.sno').text(i + 1);
                            });
                            toastr.success('User has been deleted');
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message)
                        }
                    });

                    // =========== without ajax ===========
                    // var form = $('<form></form>');
                    // form.attr('method', 'POST');
                    // form.attr('action', url);
                    // form.append($('<input>').attr({
                    //     type: 'hidden',
                    //     name: '_token',
                    //     value: $('meta[name="csrf-token"]').attr('content')
                    // }));
                    // form.append($('<input>').attr({
                    //     type: 'hidden',
                    //     name: '_method',
                    //     value: 'DELETE'
                    // }))
                    // $('body').append(form);
                    // form.submit();
                }
            })
        })
    </script>
@endpush
