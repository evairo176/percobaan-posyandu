@extends('layouts.backend')
@section('title','kepengurusan')
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
    ul.ul-kepengurusan {
        padding: 0;
        list-style: none;
    }

    ul.ul-kepengurusan-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }

    li {
        list-style: none;
    }

    p.kat-1 {
        font-weight: 800;
    }

    p.kat-2 {
        font-weight: 700;
    }

    p.kat-3 {
        font-weight: 500;
    }

    .ul-1 {
        padding: 0;
        margin-bottom: 30px;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="kepengurusan_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table kepengurusan</h4>
                        @if(!auth()->user()->status_kepengurusan)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnkepengurusan">
                            Add New kepengurusan
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
                            <th>Ketua Multifungsi</th>
                            <th>Bendahara Multifungsi</th>
                            <th>Seksi / bidang Multifungsi</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- -- kepengurusan modal start -- -->

<div class="modal fade" id="kepengurusanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kepengurusanModalTitle">Add New kepengurusan</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="kepengurusan_form">
                    @csrf
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">1. Posyandu Multifungsi</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_kepengurusan">Ketua</label>
                                        <input type="hidden" name="kepengurusan_id" id="kepengurusan_id" class="form-control">
                                        <input type="text" name="ket_m" id="ket_m" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">bendahara</label>
                                        <input type="text" name="bend_m" id="bend_m" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">seksi / bidang</label>
                                        <textarea class="form-control" name="sek_m" id="sek_m" cols="10" rows="4"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">2. Kelompok Kegiatan Pokok</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_kepengurusan">Ketua</label>
                                        <input type="text" name="ket_kkp" id="ket_kkp" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">bendahara</label>
                                        <input type="text" name="bend_kkp" id="bend_kkp" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">seksi / bidang</label>
                                        <textarea class="form-control" name="sek_kkp" id="sek_kkp" cols="10" rows="4"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">3. Kelompok Kegiatan BKB</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_kepengurusan">Ketua</label>
                                        <input type="text" name="ket_kkb" id="ket_kkb" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">bendahara</label>
                                        <input type="text" name="bend_kkb" id="bend_kkb" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">seksi / bidang</label>
                                        <textarea class="form-control" name="sek_kkb" id="sek_kkb" cols="10" rows="4"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">4. Kelompok Kegiatan Bidang pendidikan / paud</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_kepengurusan">Ketua</label>
                                        <input type="text" name="ket_kkbp" id="ket_kkbp" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">bendahara</label>
                                        <input type="text" name="bend_kkbp" id="bend_kkbp" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">seksi / bidang</label>
                                        <textarea class="form-control" name="sek_kkbp" id="sek_kkbp" cols="10" rows="4"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">5. Kelompok Kegiatan Bidang Ekonomi / UP2K /UPPKS</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_kepengurusan">Ketua</label>
                                        <input type="text" name="ket_kkbe" id="ket_kkbe" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">bendahara</label>
                                        <input type="text" name="bend_kkbe" id="bend_kkbe" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_kepengurusan">seksi / bidang</label>
                                        <textarea class="form-control" name="sek_kkbe" id="sek_kkbe" cols="10" rows="4"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="kepengurusan_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- kepengurusan modal end -- -->



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
            ajax: "{{route('kepengurusan.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'ket_m',
                    name: 'ket_m'
                },
                {
                    data: 'bend_m',
                    name: 'bend_m'
                },
                {
                    data: 'sek_m',
                    name: 'sek_m'
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
        $('#btnkepengurusan').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#kepengurusan_form')[0].reset();
            $('#kepengurusanModalTitle').html('Add Data kepengurusan');
            $('#kepengurusan_btn').html('Save');
            $('#kepengurusanModal').modal('show');
        });
        // edit kepengurusan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'kepengurusan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#kepengurusanModalTitle').html('Edit Data kepengurusan');
                    $('#kepengurusan_btn').html('Update');
                    $('#kepengurusanModal').modal('show');
                    $("#kepengurusan_id").val(res.id);
                    $("#ket_m").val(res.ket_m);
                    $("#bend_m").val(res.bend_m);
                    $("#ket_m").val(res.ket_m);
                    $("#ket_kkp").val(res.ket_kkp);
                    $("#bend_kkp").val(res.bend_kkp);
                    $("#sek_kkp").val(res.sek_kkp);
                    $("#ket_kkb").val(res.ket_kkb);
                    $("#bend_kkb").val(res.bend_kkb);
                    $("#sek_kkb").val(res.sek_kkb);
                    $("#ket_kkbp").val(res.ket_kkbp);
                    $("#bend_kkbp").val(res.bend_kkbp);
                    $("#sek_kkbp").val(res.sek_kkbp);
                    $("#ket_kkbe").val(res.ket_kkbe);
                    $("#bend_kkbe").val(res.bend_kkbe);
                    $("#sek_kkbe").val(res.sek_kkbe);
                }
            });
        });
        $('#kepengurusan_form').submit(function(e) {
            e.preventDefault();

            let id = $('#kepengurusan_id').val();
            const fd = new FormData(this);
            $('#kepengurusan_btn').val('Simpan...');
            $('#kepengurusan_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/kepengurusan/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('ket_m', res.messages.ket_m);
                        showError('bend_m', res.messages.bend_m);
                        showError('sek_m', res.messages.sek_m);
                        showError('ket_kkp', res.messages.ket_kkp);
                        showError('bend_kkp', res.messages.bend_kkp);
                        showError('sek_kkp', res.messages.sek_kkp);
                        showError('ket_kkb', res.messages.ket_kkb);
                        showError('bend_kkb', res.messages.bend_kkb);
                        showError('sek_kkb', res.messages.sek_kkb);
                        showError('ket_kkbp', res.messages.ket_kkbp);
                        showError('bend_kkbp', res.messages.bend_kkbp);
                        showError('sek_kkbp', res.messages.sek_kkbp);
                        showError('ket_kkbe', res.messages.ket_kkbe);
                        showError('bend_kkbe', res.messages.bend_kkbe);
                        showError('sek_kkbe', res.messages.sek_kkbe);
                        $('#kepengurusan_btn').val('Simpan Data Kepengurusan');
                        $('#kepengurusan_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#kepengurusan_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#kepengurusan_form')
                        $('#kepengurusan_btn').val('Simpan Data Kepengurusan');
                        $('#kepengurusan_btn').removeAttr('disabled');
                        $('#kepengurusanModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnkepengurusan').addClass('d-none');
                    }
                }
            })
        })

    });
</script>
@endpush