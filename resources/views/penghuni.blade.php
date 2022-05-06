@extends('layouts.main')

@section('container')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Data Penghuni</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penghuni</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 d-flex justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <div class="dropdown mr-2 hidden-sm-down">
                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#primary-header-modal" aria-haspopup="true" aria-expanded="false"><i data-feather="plus-circle" class="feather-icon"></i> Tambah Data Penghuni </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            @php($i = 1)
            @if(count($penghuni) > 0)
            <!-- Column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Penghuni</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Asal</th>
                                        <th>No Hp</th>
                                        <th>No Kamar</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Lama Sewa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach($penghuni as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->asal}}</td>
                                        <td>0{{$item->no_hp}}</td>
                                        <td>{{$item->no_kamar}}</td>
                                        <!-- <td>{{$item->tgl_masuk}}</td> -->
                                        <td>{{tgl_indo($item->tgl_masuk, 'd M  Y');}}</td>
                                        <td>{{$item->lama_sewa}} Bulan</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning editPenghuni" data-id="{{ $item->id }}"><i data-feather="edit" class="feather-icon"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger deletePenghuni" data-id="{{ $item->id }}" data-kamar="{{$item->id_kamar}}"><i data-feather="trash" class="feather-icon"></i></a>
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
    <!-- Primary Create Modal -->
    <div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">Tambah Data Penghuni
                    </h4>
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h5 class="mt-2">Nama</h5>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Asal</h5>
                    <input type="text" class="form-control" id="asal" name="asal" placeholder="Masukan Asal" aria-describedby="basic-addon1">
                    <h5 class="mt-2">No Hp (Tanpa angka 0 diawal)</h5>
                    <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="No Hp" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Tanggal Masuk</h5>
                    <input id="startDate" class="form-control" type="date" id="tgl_masuk" name="tgl_masuk" />
                    <h5 class="mt-2">Lama Sewa (Bulan)</h5>
                    <input type="text" class="form-control" id="lama" name="lama" placeholder="Lama Sewa" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Pilih No Kamar</h5>
                    <select class="form-control" aria-label="Default select example" id="kamar" name="kamar">
                    @foreach( $kamar as $item)
                        <option value="{{$item->id}}">{{$item->no_kamar}}</option>
                    @endforeach
                    </select>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" onclick="store()">Tambah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div id="primary-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">Edit Data Penghuni
                    </h4>
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="ide" name="ide">
                    <h5 class="mt-2">Nama</h5>
                    <input type="text" class="form-control" id="namae" name="namae" placeholder="Masukan Nama" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Asal</h5>
                    <input type="text" class="form-control" id="asale" name="asale" placeholder="Masukan Asal" aria-describedby="basic-addon1">
                    <h5 class="mt-2">No Hp</h5>
                    <input type="text" class="form-control" id="no_tlpe" name="no_tlpe" placeholder="No Hp" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Tanggal Masuk</h5>
                    <input class="form-control" type="text" id="tgl_masuke" name="tgl_masuke" readonly>
                    <h5 class="mt-2">Lama Sewa (Bulan)</h5>
                    <input type="text" class="form-control" id="lamae" name="lamae" placeholder="Lama Sewa" aria-describedby="basic-addon1">
                    <h5 class="mt-2">Posisi Kamar Sekarang</h5>
                    <input class="form-control" type="text" id="kamarv" name="kamarv" readonly>
                    <input type="hidden" class="form-control" id="kamare" name="kamare">
                    <h5 class="mt-2">Pilih No Kamar</h5>
                    <select class="form-control" aria-label="Default select example" id="kamar_baru" name="kamar_baru">
                        <option value="">pilih kamar</option>
                    @foreach( $kamar as $item)
                        <option value="{{$item->id}}">{{$item->no_kamar}}</option>
                    @endforeach
                    </select>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btnedit">Ubah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
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
<script>
    $(document).ready(function($){
        
        $('body').on('click', '.editPenghuni', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('editPenghuni')}}",
                data: {
                    'id': id,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    $('#primary-edit-modal').modal('show');
                    $('#ide').val(res.id);
                    $('#namae').val(res.nama);
                    $('#asale').val(res.asal);
                    $('#no_tlpe').val(res.no_hp);
                    $('#tgl_masuke').val(formatDate(res.tgl_masuk));
                    $('#lamae').val(res.lama_sewa);
                    $('#kamare').val(res.id_kamar);
                    $('#kamarv').val(res.no_kamar);
                    // $('#kamare').val($(res.id_kamar).html());
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                }
            });

        });

        $('body').on('click', '#btnedit', function() {
            var id = $("#ide").val();
            var nama = $("#namae").val();
            var asal = $("#asale").val();
            var no_tlp = $("#no_tlpe").val();
            var lama = $("#lamae").val();
            var kamar = $("#kamare").val();
            var kamar_baru = $("#kamar_baru").val();
            // console.log(id, nama, asal, no_tlp, lama, kamar, kamar_baru);

            $.ajax({
                type: "POST",
                url: "{{url('updatePenghuni')}}",
                data: {
                    'id': id,
                    'nama': nama,
                    'asal': asal,
                    'no_tlp': no_tlp,
                    'lama': lama,
                    'kamar': kamar,
                    'kamar_baru': kamar_baru,
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


        $('body').on('click', '.deletePenghuni', function() {
            var id = $(this).data('id');
            var id_kamar = $(this).data('kamar');

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
                        url: "{{url('deletePenghuni')}}",
                        data: {
                            'id': id,
                            'id_kamar': id_kamar,
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
        var nama = $("#nama").val();
        var no_tlp = $("#no_tlp").val();
        var asal = $("#asal").val();
        var tgl_masuk = $('input[name=tgl_masuk]').val();
        var lama = $("#lama").val();
        var kamar = $("#kamar").val();

        $.ajax({
            type: "POST",
            url: "{{url('storepenghuni')}}",
            data: {
                'nama': nama,
                'no_tlp': no_tlp,
                'asal': asal,
                'tgl_masuk': tgl_masuk,
                'lama': lama,
                'kamar': kamar,
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
                // console.log(data);
                setTimeout(location.reload.bind(location), 1000);
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);

            }
        });
    }

    function formatDate(dateString) {
      var allDate = dateString.split(' ');
      var thisDate = allDate[0].split('-');
      var newDate = [thisDate[2], thisDate[1], thisDate[0]].join("-");
      return newDate;
  }
  
</script>
@endsection