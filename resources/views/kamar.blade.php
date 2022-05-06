@extends('layouts.main')

@section('container')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Kamar</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kamar</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 d-flex justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <div class="dropdown mr-2 hidden-sm-down">
                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#primary-header-modal" aria-haspopup="true" aria-expanded="false"><i data-feather="plus-circle" class="feather-icon"></i> Tambah Kamar </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            @php($i = 1)
            @if(count($kamar) > 0)
            <!-- Column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Kamar</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Kamar</th>
                                        <th>Fasilitas</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach($kamar as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->no_kamar}}</td>
                                        <td>{{$item->fasilitas}}</td>
                                        <td>{{$item->harga}}</td>
                                        <td>
                                            @if($item->status == 0)
                                            <span class="badge badge-pill badge-success">Kosong</span>
                                            @else
                                            <span class="badge badge-pill badge-secondary">Terisi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning editKamar" data-id="{{ $item->id }}"><i data-feather="edit" class="feather-icon"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger deletekamar" data-id="{{ $item->id }}"><i data-feather="trash" class="feather-icon"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            @else
            <h2 class="font-weight-light mb-0">Data tidak tersedia, silahkan tambahkan data</h2>
            @endif
        </div>
        <!-- Row -->
    </div>
    <!-- ============================================================== -->
    <!-- Primary Modal Tambah -->
    <div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">Tambah Kamar
                    </h4>
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h5 class="mt-2">No kamar/kode</h5>
                    <input type="text" class="form-control" id="no_kamar" name="no_kamar" placeholder="Masukan No Kamar/kode" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Fasilitas</h5>
                    <input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Masukan Fasilitas" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Tarif perbulan</h5>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Tarif perbulan" aria-describedby="basic-addon1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" onclick="store()">Tambah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Primary Modal Edit -->
    <div id="primary-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-edit-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title text-white" id="primary-edit-modalLabel">Edit Kamar
                    </h4>
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="ide" name="ide">
                    <h5 class="mt-2">No kamar/kode</h5>
                    <input type="text" class="form-control" id="no_kamare" name="no_kamare" placeholder="Masukan No Kamar/kode" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Fasilitas</h5>
                    <input type="text" class="form-control" id="fasilitase" name="fasilitase" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Tarif perbulan</h5>
                    <input type="text" class="form-control" id="hargae" name="hargae" aria-describedby="basic-addon1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btnedit">Ubah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        © 2020 Monster Admin by wrappixel.com
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function($) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.editKamar', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('editkamar')}}",
                data: {
                    'id': id,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    $('#primary-edit-modal').modal('show');
                    $('#ide').val(res.id);
                    $('#no_kamare').val(res.no_kamar);
                    $('#fasilitase').val(res.fasilitas);
                    $('#hargae').val(res.harga);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                }
            });

        });

        $('body').on('click', '#btnedit', function() {
            var id = $("#ide").val();
            var no_kamar = $("#no_kamare").val();
            var fasilitas = $("#fasilitase").val();
            var harga = $("#hargae").val();
            $.ajax({
                type: "POST",
                url: "{{url('update')}}",
                data: {
                    'id': id,
                    'no_kamar': no_kamar,
                    'fasilitas': fasilitas,
                    'harga': harga,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Ubah Data',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(location.reload.bind(location), 1000);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                }
            });
        });

        $('body').on('click', '.deletekamar', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah yakin akan menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('deletekamar')}}",
                        data: {
                            'id': id,
                            _token: '{{csrf_token()}}',
                        },
                        dataType: 'json',
                        success: function(res) {
                            consolo.log(res);
                        },
                        error: function(data, textStatus, errorThrown) {
                            console.log(data);

                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    setTimeout(location.reload.bind(location), 500);
                }
            })
        });

    });


    function store() {
        var no_kamar = $("#no_kamar").val();
        var fasilitas = $("#fasilitas").val();
        var harga = $("#harga").val();
        $.ajax({
            type: "POST",
            url: "{{url('store')}}",
            data: {
                'no_kamar': no_kamar,
                'fasilitas': fasilitas,
                'harga': harga,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Tambah Data',
                    showConfirmButton: false,
                    timer: 1000
                })
                setTimeout(location.reload.bind(location), 1000);
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);

            }
        });
    }
</script>
@endsection