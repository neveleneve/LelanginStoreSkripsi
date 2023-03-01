@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- carousel --}}
        <div class="row justify-content-center mb-3 d-none d-lg-block">
            <div class="col-12 ">
                <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100"
                                alt="Sunset Over the City" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100"
                                alt="Canyon at Nigh" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100"
                                alt="Cliff Above a Stormy Sea" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                        </div>
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
            </div>
        </div>
        <hr class="d-none d-lg-block">
        {{-- list barang terbaru --}}
        @if (count($databaru) > 0)
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 mb-3 mb-lg-2">
                    <h2 class="h3 fw-bold">Segera Dimulai</h2>
                </div>
                <div class="col-12 col-lg-6 mb-3 mb-lg-2 d-none d-lg-block text-end">
                    <a href="{{ route('startsoon') }}" class="h6 text-dark">
                        <u>
                            Lihat lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr class="hr mt-0">
            <div class="row justify-content-center mb-3">
                @forelse ($databaru as $item)
                    <div class="col-12 col-lg-3 mb-3 mb-lg-0">
<<<<<<< HEAD
                        <div class="card h-100">
=======
                        <div class="card">
>>>>>>> 8ee5839a039d6eae5bc049035330fefc1333eda0
                            <div class="ratio ratio-1x1 bg-image">
                                <img src="{{ App\Http\Controllers\Controller::checkImage($item->id_item . '_' . $item->id_user) }}"
                                    class="card-img-top object-cover object-center" alt="Fissure in Sandstone">
                                <div class="mask" style="background-color: rgba(0, 0, 0, 0.1)"></div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title h6">
                                    <a class="fw-bold text-dark"
                                        href="{{ route('viewitem', ['id' => base64_encode($item->id_item . '|' . $item->id . '|' . $item->username)]) }}">
                                        {{ strtoupper($item->name) }}
                                    </a>
                                    <br>
                                    @if ($item->start_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-warning">Belum dimulai</span>
                                    @elseif ($item->start_date < date('Y-m-d H:i:s') && $item->end_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-primary">Berlangsung</span>
                                    @elseif ($item->end_date < date('Y-m-d H:i:s'))
                                        <span class="badge bg-danger">Sudah Berakhir</span>
                                    @endif
                                    {{-- <span class="badge bg-primary">Added</span> --}}
                                </h5>
                                <small>by
                                    <a class="text-dark fw-bold"
                                        href="{{ route('viewprofile', ['id' => $item->username]) }}">
                                        {{ strtolower($item->username) }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <h3 class="text-center">Data Kosong</h3>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center d-block d-lg-none">
                <div class="col-12 text-center">
                    <a class="fw-bold text-dark" href="{{ route('startsoon') }}">
                        <u>
                            Lihat Lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr>
        @endif
        {{-- List barang hampir selesai --}}
        @if (count($datahampirselesai) > 0)
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="h3 fw-bold">Hampir Selesai</h2>
                </div>
                <div class="col-12 col-lg-6 mb-3 mb-lg-2 d-none d-lg-block text-end">
                    <a href="{{ route('endsoon') }}" class="h6 text-dark">
                        <u>
                            Lihat lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr class="hr mt-0">
            <div class="row justify-content-center mb-3">
                @forelse ($datahampirselesai as $item)
                    <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                        <div class="card h-100">
                            <a class="fw-bold text-dark"
                                href="{{ route('viewitem', ['id' => base64_encode($item->id_item . '|' . $item->id . '|' . $item->username)]) }}">
                                <div class="ratio ratio-1x1 bg-image">
                                    <img src="{{ App\Http\Controllers\Controller::checkImage($item->id_item . '_' . $item->id_user) }}"
                                        class="card-img-top object-cover object-center" alt="Fissure in Sandstone">
                                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.1)"></div>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title h6">
                                    <a class="fw-bold text-dark"
                                        href="{{ route('viewitem', ['id' => base64_encode($item->id_item . '|' . $item->id . '|' . $item->username)]) }}">
                                        {{ strtoupper($item->name) }}
                                    </a>
                                    <br>
                                    @if ($item->start_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-warning">Belum dimulai</span>
                                    @elseif ($item->start_date < date('Y-m-d H:i:s') && $item->end_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-primary">Berlangsung</span>
                                    @elseif ($item->end_date < date('Y-m-d H:i:s'))
                                        <span class="badge bg-danger">Sudah Berakhir</span>
                                    @endif
                                </h5>
                                <small>by
                                    <a class="text-dark fw-bold"
                                        href="{{ route('viewprofile', ['id' => $item->username]) }}">
                                        {{ strtolower($item->username) }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <h3 class="text-center">Data Kosong</h3>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center d-block d-lg-none">
                <div class="col-12 text-center">
                    <a class="fw-bold text-dark" href="{{ route('endsoon') }}">
                        <u>
                            Lihat Lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr>
        @endif
        {{-- sudah selesai --}}
        @if (count($dataselesai) > 0)
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="h3 fw-bold">Lelang Selesai</h2>
                </div>
                <div class="col-12 col-lg-6 mb-3 mb-lg-2 d-none d-lg-block text-end">
                    <a href="{{ route('ended') }}" class="h6 text-dark">
                        <u>
                            Lihat lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr class="hr mt-0">
            <div class="row justify-content-center mb-3">
                @forelse ($dataselesai as $item)
<<<<<<< HEAD
                    <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                        <div class="card h-100">
=======
                    <div class="col-12 col-lg-3 mb-3 mb-lg-0 ">
                        <div class="card">
>>>>>>> 8ee5839a039d6eae5bc049035330fefc1333eda0
                            <a class="fw-bold text-dark"
                                href="{{ route('viewitem', ['id' => base64_encode($item->id_item . '|' . $item->id . '|' . $item->username)]) }}">
                                <div class="ratio ratio-1x1 bg-image">
                                    <img src="{{ App\Http\Controllers\Controller::checkImage($item->id_item . '_' . $item->id_user) }}"
                                        class="card-img-top object-cover object-center" alt="Fissure in Sandstone">
                                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.1)"></div>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title h6">
                                    <a class="fw-bold text-dark"
                                        href="{{ route('viewitem', ['id' => base64_encode($item->id_item . '|' . $item->id . '|' . $item->username)]) }}">
                                        {{ strtoupper($item->name) }}
                                    </a>
                                    <br>
                                    @if ($item->start_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-warning">Belum dimulai</span>
                                    @elseif ($item->start_date < date('Y-m-d H:i:s') && $item->end_date > date('Y-m-d H:i:s'))
                                        <span class="badge bg-primary">Berlangsung</span>
                                    @elseif ($item->end_date < date('Y-m-d H:i:s'))
                                        <span class="badge bg-danger">Sudah Berakhir</span>
                                    @endif
                                </h5>
                                <small>by
                                    <a class="text-dark fw-bold"
                                        href="{{ route('viewprofile', ['id' => $item->username]) }}">
                                        {{ strtolower($item->username) }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <h3 class="text-center">Data Kosong</h3>
                    </div>
                @endforelse
            </div>
            <div class="row justify-content-center d-block d-lg-none">
                <div class="col-12 text-center">
                    <a class="fw-bold text-dark" href="{{ route('endsoon') }}">
                        <u>
                            Lihat Lainnya
                        </u>
                    </a>
                </div>
            </div>
            <hr>
        @endif
    </div>
@endsection
