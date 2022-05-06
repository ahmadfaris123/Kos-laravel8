@extends('layouts.main')

@section('container')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Pembayaran</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <!--  -->
            @if(count($tagihan) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Tagihan</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @php($i = 1)
                                @foreach($tagihan as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->tagihan}}.000</td>
                                        <td>{{tgl_indo($item->tgl_masuk, 'd M  Y');}}</td>
                                        <td>{{tgl_indo($item->deadline, 'd M  Y');}}</td>
                                        <td>
                                            @if($item->status == 0)
                                            <span class="badge badge-pill badge-danger">Belum Bayar</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success bayar" data-id="{{ $item->id }}"><i data-feather="check" class="feather-icon"></i></a>
                                            <a href="https://api.whatsapp.com/send?phone=6287834099599&text=Informasi%20Tagihan%20Kos%0A%20%20%20%20%20%20%20%20%0ANama%3A%20{{$item->nama}}%0AJumlah%20Tagihan%3A%20{{$item->tagihan}}%2C000%20%0ABatas%20Akhir%20Pembayaran%3A%20{{$item->deadline}}%0A%0APesan%20ini%20tidak%20perlu%20dibalas" class="btn btn-primary deletePenghuni" data-id=""><i data-feather="external-link" class="feather-icon"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <h2 class="font-weight-light mb-0">Data tidak tersedia, silahkan tambahkan data</h2>
            @endif
            <!-- Column -->
        </div>
        <!-- Row -->
    </div>
    <!-- ============================================================== -->
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
    $(document).ready(function($) {
        $('body').on('click', '.bayar', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('bayar')}}",
                data: {
                    'id': id,
                    'tgl_bayar' : today,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(res);
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(location.reload.bind(location), 1000);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                }
            });
        })
    });
</script>
@endsection