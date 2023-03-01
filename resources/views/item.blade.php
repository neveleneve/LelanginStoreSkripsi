@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                        @if ($gambar > 0)
                            <div id="carouselBasicExample" class="carousel slide" data-mdb-ride="carousel">
                                <div class="carousel-indicators">
                                    @for ($i = 0; $i < $gambar; $i++)
                                        <button type="button" data-mdb-target="#carouselBasicExample"
                                            data-mdb-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"
                                            aria-current="true"></button>
                                    @endfor
                                </div>
                                <div class="carousel-inner rounded-5 shadow-4-strong text-center">
                                    @for ($i = 0; $i < $gambar; $i++)
                                        <div class="carousel-item ratio ratio-1x1 bg-image{{ $i == 0 ? ' active' : '' }}">
                                            <img class="img img-fluid img-responsive object-cover object-center"
                                                src="{{ url('images/' . $item->id_item . '_' . $item->id_user . '/' . ($i + 1) . '.png') }}">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.1)"></div>
                                        </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                                    data-mdb-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                                    data-mdb-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="ratio ratio-1x1 bg-image shadow-4-strong">
                                <img src="{{ url('images/default.jpg') }}"
                                    class="img img-fluid img-responsive object-cover object-center" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h2 class="fw-bold">{{ $item->name }}</h2>
                                @if ($item->start_date > date('Y-m-d H:i:s'))
                                    <span class="badge bg-warning">Belum dimulai</span>
                                @elseif ($item->start_date < date('Y-m-d H:i:s') && $item->end_date > date('Y-m-d H:i:s'))
                                    <span class="badge bg-primary">Sedang berlangsung</span>
                                @elseif ($item->end_date < date('Y-m-d H:i:s'))
                                    <span class="badge bg-danger">Sudah Berakhir</span>
                                @endif
                            </div>
                            <div class="col-12">
                                by <a class="text-dark fw-bold"
                                    href="{{ route('viewprofile', ['id' => $item->username]) }}">
                                    {{ $item->username }}
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="fw-bold">Harga Mulai</h5>
                                <h6 class="fw-bold">Rp. {{ number_format($item->start_price, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="fw-bold">Tanggal Mulai Lelang</h5>
                                <h6 class="fw-bold">{{ App\Http\Controllers\Controller::tanggalIndo($item->start_date) }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="fw-bold">Tanggal Tutup Lelang</h5>
                                <h6 class="fw-bold">{{ App\Http\Controllers\Controller::tanggalIndo($item->end_date) }}
                                </h6>
                            </div>
                        </div>
                        @if ($item->start_date < date('Y-m-d H:i:s') && $item->end_date > date('Y-m-d H:i:s'))
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="fw-bold">
                                        {{ count($penawaran) == 0 ? 'Harga Awal Penawaran' : 'Harga Penawaran Terakhir' }}
                                    </h5>
                                    <h6 class="fw-bold">
                                        Rp.
                                        {{ count($penawaran) == 0 ? number_format($item->start_price, 0, ',', '.') : number_format($penawaran[0]['penawaran'], 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-6">
                        @if ($auth)
                            @if (Auth::user()->role == 2)
                                <a class="btn btn-outline-success btn-block fw-bold">
                                    Kamu harus punya akun peserta lelang untuk ikut lelang!
                                </a>
                            @elseif (Auth::user()->role == 3)
                                @if (date('Y-m-d H:i:s', strtotime($item->start_date)) > date('Y-m-d H:i:s'))
                                    <a class="btn btn-outline-success btn-block fw-bold">
                                        Lelang belum dimulai!
                                    </a>
                                @elseif(date('Y-m-d H:i:s', strtotime($item->end_date)) < date('Y-m-d H:i:s'))
                                    <a class="btn btn-outline-success btn-block fw-bold">
                                        Lelang sudah selesai
                                    </a>
                                @else
                                    @if ($joinbid == null)
                                        <button target="__blank" class="btn btn-outline-success btn-block fw-bold"
                                            data-mdb-toggle="modal" data-mdb-target="#konfirmasiikutlelang">
                                            Ikuti lelang ini
                                        </button>
                                    @else
                                        @if ($joinbid->payment_status == 1 || $joinbid->payment_status == 2)
                                            <div class="row">
                                                <div
                                                    class="col-12{{ $joinbid->payment_status == 2 ? ' col-lg-6' : '' }} mb-3 mb-lg-0">
                                                    <a target="__blank" class="btn btn-outline-success btn-block fw-bold"
                                                        href="https://app.sandbox.midtrans.com/snap/v3/redirection/{{ $joinbid->snap_token }}">
                                                        Menunggu pembayaran
                                                    </a>
                                                </div>
                                                @if ($joinbid->payment_status == 2)
                                                    <form class="col-12 col-lg-6 mb-3 mb-lg-0" method="POST"
                                                        action="{{ route('cancelpayment') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $itemmark }}">
                                                        <input type="hidden" name="number"
                                                            value="{{ $joinbid->number }}">
                                                        <button type="submit" class="btn btn-success btn-block fw-bold"
                                                            onclick="return confirm('Batalkan ikut lelang?')">
                                                            Batal ikut lelang
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @elseif ($joinbid->payment_status == 3 || $joinbid->payment_status == 5)
                                            <button target="__blank" class="btn btn-outline-success btn-block fw-bold"
                                                data-mdb-toggle="modal" data-mdb-target="#konfirmasiikutlelang">
                                                Ikuti lelang ini
                                            </button>
                                        @elseif ($joinbid->payment_status == 4)
                                            <button class="btn btn-outline-success btn-block fw-bold"
                                                data-mdb-toggle="modal" data-mdb-target="#penawaran">
                                                Masukkan harga penawaran
                                            </button>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @else
                            <a class="btn btn-outline-success btn-block fw-bold" href="{{ route('login') }}">
                                Mau ikut lelang? Login sebagai peserta lelang disini!
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="fw-bold text-center mb-3">Penawaran Masuk</h3>
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr class="fw-bold">
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Username</th>
                            <th class="fw-bold">Penawaran</th>
                            <th class="fw-bold">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penawaran as $itemx)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ App\Http\Controllers\Controller::cencorName($itemx->username) }}</td>
                                <td>Rp. {{ number_format($itemx->penawaran, 0, ',', '.') }}</td>
                                <td>{{ App\Http\Controllers\Controller::tanggalIndo($itemx->created_at) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h2 class="text-center fw-bold">Belum ada penawaran</h2>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($auth)
        @if (Auth::user()->role == 2)
        @elseif (Auth::user()->role == 3)
            @if (date('Y-m-d H:i:s', strtotime($item->start_date)) > date('Y-m-d H:i:s'))
                a
            @elseif(date('Y-m-d H:i:s', strtotime($item->end_date)) < date('Y-m-d H:i:s'))
                b
            @else
                @if ($joinbid == null)
                    <div class="modal fade" id="konfirmasiikutlelang" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content text-center">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <h4 class="fw-bold">Ikuti lelang ini?</h4>
                                    <p>Kamu diwajibkan untuk membayar uang ikut serta lelang sebesar Rp. 50.000 pada
                                        setiap
                                        item yang ingin kamu ikuti</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('joinbid') }}" method="post" target="__blank">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="id_item" value="{{ $item->id }}">
                                        <button type="button" class="btn btn-success fw-bold"
                                            data-mdb-dismiss="modal">Batalkan</button>
                                        <button type="submit" class="btn btn-outline-success fw-bold"
                                            data-mdb-dismiss="modal">Ya!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @if ($joinbid->payment_status == 1 || $joinbid->payment_status == 2)
                    @elseif ($joinbid->payment_status == 3 || $joinbid->payment_status == 5)
                        <div class="modal fade" id="konfirmasiikutlelang" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content text-center">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <h4 class="fw-bold">Ikuti lelang ini?</h4>
                                        <p>Kamu diwajibkan untuk membayar uang ikut serta lelang sebesar Rp. 50.000 pada
                                            setiap
                                            item yang ingin kamu ikuti</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('joinbid') }}" method="post" target="__blank">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="id_item" value="{{ $item->id }}">
                                            <button type="button" class="btn btn-success fw-bold"
                                                data-mdb-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-outline-success fw-bold"
                                                data-mdb-dismiss="modal">Ya!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($joinbid->payment_status == 4)
                        <div class="modal fade" id="penawaran" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content text-center">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Penawaran</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pesertaikutlelang') }}" method="post">
                                        <div class="modal-body ">
                                            <h4 class="fw-bold">Harga Penawaran</h4>
                                            <input type="number" name="total_penawaran" id="total_penawaran"
                                                placeholder="Input Total Penawaran" class="form-control"
                                                value="{{ count($penawaran) == 0 ? $item->start_price : $penawaran[0]['penawaran'] }}"
                                                min="{{ count($penawaran) == 0 ? $item->start_price : $penawaran[0]['penawaran'] }}"
                                                step="10000">
                                        </div>
                                        <div class="modal-footer">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="id_item" value="{{ $item->id }}">
                                            <input type="hidden" name="item_mark" value="{{ $itemmark }}">
                                            <button type="button" class="btn btn-success fw-bold"
                                                data-mdb-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-outline-success fw-bold"
                                                data-mdb-dismiss="modal">Masukkan Penawaran</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @endif
    @endif
@endsection

@section('customscript')
    @if ($auth)
        <script>
            $(document).ready(function() {
                setInterval(function() {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('checkpayment') }}',
                        data: {
                            'id_item': '{{ $item->id }}',
                            'id_user': '{{ Auth::user()->id }}',
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.berubah == true) {
                                // console.log(data.berubah);
                                location.reload();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                        },
                    });
                }, 1000);
            });
        </script>
    @endif
@endsection
