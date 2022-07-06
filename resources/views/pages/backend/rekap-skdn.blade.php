@extends('layouts.backend')
@section('title','skdn')
@push('add-styles')
<link href="{{asset('backend')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/forms/theme-checkbox-radio.css">
<link href="{{asset('backend')}}/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('datatable')}}/datatables.min.css" />
<script src="{{asset('backend')}}/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
<style>
    ul.ul-skdn {
        padding: 0;
        list-style: none;
    }

    ul.ul-skdn-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="skdn_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table skdn</h4>
                        @if(!auth()->user()->status_skdn)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnskdn">
                            Add New skdn
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-hover text-secondary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>S</th>
                            <th>K</th>
                            <th>D</th>
                            <th>N</th>
                            <th>created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- -- skdn modal start -- -->

<div class="modal fade" id="skdnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skdnModalTitle">Add New skdn</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="skdn_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_skdn">bayi dan balita sasaran posyandu / S</label>
                        <input type="hidden" name="skdn_id" id="skdn_id" class="form-control">
                        <input type="text" name="s" id="s" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_skdn">balita yang memiliki KMS / K</label>
                        <input type="text" name="k" id="k" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_skdn">bayi dan balita datang ditimbang / D</label>
                        <input type="text" name="d" id="d" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_skdn">bayi dan balita naik timbangan / N</label>
                        <input type="text" name="n" id="n" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="skdn_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- skdn modal end -- -->



@endsection

@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script type="text/javascript" src="{{asset('datatable')}}/datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
    $(function() {
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{route('skdn.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 's',
                    name: 's'
                },
                {
                    data: 'k',
                    name: 'k'
                },
                {
                    data: 'd',
                    name: 'd'
                },
                {
                    data: 'n',
                    name: 'n'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $('#btnskdn').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#skdn_form')[0].reset();
            $('#skdnModalTitle').html('Add Data skdn');
            $('#skdn_btn').html('Save');
            $('#skdnModal').modal('show');
        });
        // edit skdn ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'skdn/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#skdnModalTitle').html('Edit Data skdn');
                    $('#skdn_btn').html('Update');
                    $('#skdnModal').modal('show');
                    $("#skdn_id").val(res.id);
                    $("#s").val(res.s);
                    $("#k").val(res.k);
                    $("#d").val(res.d);
                    $("#n").val(res.n);
                }
            });
        });
        $('#skdn_form').submit(function(e) {
            e.preventDefault();

            let id = $('#skdn_id').val();
            const fd = new FormData(this);
            $('#skdn_btn').val('Simpan...');
            $('#skdn_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/skdn/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('s', res.messages.s);
                        showError('k', res.messages.k);
                        showError('d', res.messages.d);
                        showError('n', res.messages.n);
                        $('#skdn_btn').val('Simpan Data Skdn');
                        $('#skdn_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#skdn_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#skdn_form')
                        $('#skdn_btn').val('Simpan Data Skdn');
                        $('#skdn_btn').removeAttr('disabled');
                        $('#skdnModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnskdn').addClass('d-none');
                    }
                }
            })
        })
    });
</script>
@endpush