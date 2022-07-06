@extends('layouts.backend')
@section('title','kader')
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
    ul.ul-kader {
        padding: 0;
        list-style: none;
    }

    ul.ul-kader-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="kader_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table kader</h4>
                        @if(!auth()->user()->status_kader)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnkader">
                            Add New kader
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
                            <th>nama kader</th>
                            <th>umur</th>
                            <th>tahun jadi kader</th>
                            <th>pendidikan</th>
                            <th>tahun pelatihan</th>
                            <th>no hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- -- kader modal start -- -->

<div class="modal fade" id="kaderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kaderModalTitle">Add New kader</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="kader_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_kader">nama kader</label>
                        <input type="hidden" name="kader_id" id="kader_id" class="form-control">
                        <input type="text" name="nama_kader" id="nama_kader" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kader">tgl lahir</label>
                        <input type="date" name="umur" id="umur" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kader">tahun jadi kader</label>
                        <select name="tahun_jadi_kader" id="tahun_jadi_kader" class="form-control">
                            <option value="">--pilih tahun--</option>
                            <?php for ($i = date('Y'); $i >= date('Y') - 70; $i -= 1) { ?>
                                <option value="{{$i}}">{{$i}}</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kader">pendidikan</label>
                        <select name="pendidikan" id="pendidikan" class="form-control">
                            <option value="">--pilih pendidikan--</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kader">tahun pelatihan</label>
                        <select name="tahun_pelatihan" id="tahun_pelatihan" class="form-control">
                            <option value="">--pilih tahun--</option>
                            <?php for ($i = date('Y'); $i >= date('Y') - 70; $i -= 1) { ?>
                                <option value="{{$i}}">{{$i}}</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kader">no telepon</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="kader_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- kader modal end -- -->



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
            ajax: "{{route('kader.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_kader',
                    name: 'nama_kader'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'tahun_jadi_kader',
                    name: 'tahun_jadi_kader'
                },
                {
                    data: 'pendidikan',
                    name: 'pendidikan'
                },
                {
                    data: 'tahun_pelatihan',
                    name: 'tahun_pelatihan'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
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
        $('#btnkader').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#kader_form')[0].reset();
            $('#kaderModalTitle').html('Add Data kader');
            $('#kader_btn').html('Save');
            $('#kaderModal').modal('show');
        });
        // edit kader ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'kader/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#kaderModalTitle').html('Edit Data kader');
                    $('#kader_btn').html('Update');
                    $('#kaderModal').modal('show');
                    $("#kader_id").val(res.id);
                    $("#nama_kader").val(res.nama_kader);
                    $("#umur").val(res.umur);
                    $("#tahun_jadi_kader").val(res.tahun_jadi_kader);
                    $("#pendidikan").val(res.pendidikan);
                    $("#tahun_pelatihan").val(res.tahun_pelatihan);
                    $("#no_hp").val(res.no_hp);
                }
            });
        });
        $('#kader_form').submit(function(e) {
            e.preventDefault();

            let id = $('#kader_id').val();
            const fd = new FormData(this);
            $('#kader_btn').val('Simpan...');
            $('#kader_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/kader/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('nama_kader', res.messages.nama_kader);
                        showError('umur', res.messages.umur);
                        showError('tahun_jadi_kader', res.messages.tahun_jadi_kader);
                        showError('pendidikan', res.messages.pendidikan);
                        showError('tahun_pelatihan', res.messages.tahun_pelatihan);
                        showError('no_hp', res.messages.no_hp);
                        $('#kader_btn').val('Simpan Data Kader');
                        $('#kader_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#kader_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#kader_form')
                        $('#kader_btn').val('Simpan Data Kader');
                        $('#kader_btn').removeAttr('disabled');
                        $('#kaderModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                    }
                }
            })
        })
    });
</script>
@endpush