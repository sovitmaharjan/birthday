<script>
    var resizefunc = [];
</script>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('assets/js/jquery.app.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var table = $('.data-table').DataTable();

    $(document).on('click', '.delete', function() {
        var row = $(this).closest('tr');
        var id = $(this).data('id');
        var url = $(this).data('api-url');
        // var url = $(this).data('web-url'); // without ajax url
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
                // var url = "{{ route('api.user.destroy', ':id') }}";
                // url = url.replace(":id", id);
                $.ajax({
                    type: 'POST',
                    data: {
                        '_method': 'delete'
                    },
                    url: url,
                    success: function() {
                        table.row(row).remove().draw();
                        var rows = table.rows().nodes();
                        rows.each(function(e, i) {
                            $(e).find('.sno').text(i + 1);
                        });
                        toastr.success('User has been deleted');
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message)
                    }
                });

                // // =========== without ajax ===========
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

@include('layouts.partials.validation')
@include('layouts.partials.session-message')
@stack('script')
