@extends('layouts.partials.app')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('style')
@endsection


@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

{{-- @section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card" style="border-radius:15px">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bottom" id="bottom-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                    href="#dashboard" role="tab" aria-controls="dashboard"
                                    aria-selected="true">Dashboard</a></li>
                        </ul>
                        <div class="tab-content" id="bottom-tabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">
                                <div class="card-body row pricing-content">
                                    @foreach ($dashboardhomes as $dashboardhome)
                                        @if ($dashboardhome->type_id == 1)
                                            @foreach ($dashboardhome->images->sortBy('no') as $image)
                                                <div class="col-xl-4 col-sm-6 xl-50 box-col-6">
                                                    <div class="card text-center pricing-simple">
                                                        <div class="card-body">
                                                            <div class="img-container">
                                                                <div class="my-gallery" id="aniimated-thumbnials"
                                                                    itemscope="">
                                                                    <figure itemprop="associatedMedia" itemscope="">
                                                                        {{-- <a href="../assets/images/other-images/profile-style-img3.png" itemprop="contentUrl" data-size="1600x950"> --}}
                                                                        <img class="img-fluid rounded"
                                                                            src="{{ asset('storage/dashboard/' . $image->foto) }}"
                                                                            itemprop="thumbnail" alt="gallery">
                                                                        {{-- </a> --}}
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <h6 class="mb-0">{{ $image->name }} </h6>
                                                        </div><a class="btn btn-lg btn-primary btn-block"
                                                            href="{{ url($image->url) }}">Go Somewhere</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade " id="bottom-profile" role="tabpanel"
                                aria-labelledby="profile-bottom-tab">
                                <div class="card-body row pricing-content">
                                    @foreach ($dashboardhomes as $dashboardhome)
                                        @if ($dashboardhome->type_id == 2)
                                            @foreach ($dashboardhome->tabs->sortBy('no') as $tab)
                                                @if ($tab->type_id == 4)
                                                    <div id="carouselExampleControls" class="carousel slide"
                                                        data-bs-ride="carousel">
                                                        <div class="carousel-inner text-center"
                                                            style="background-color: #ecf3fa;">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($tab->slideshows->images as $image)
                                                                <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                    <img class="d-blocktext-center"
                                                                        src="{{ asset('storage/dashboard/' . $image->foto) }}"
                                                                        alt="{{ $image->foto }}"
                                                                        style="max-height: 800px;">
                                                                    <div class="carousel-caption d-none d-md-block">
                                                                        <h5>{{ $image->name }}</h5>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button class="carousel-control-prev" type="button"
                                                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span>Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button"
                                                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span>Next</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('script')

@endsection
