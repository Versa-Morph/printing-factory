@extends('auth.layouts.app')

@section('content-auth')
    <div class="auth-page d-flex align-items-center min-vh-100">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-between d-flex align-items-center mb-4">
                                <h4 class="card-title">Banner</h4>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators list-unstyled">
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="active"></li>
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/small/img-3.jpg') }}"alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/small/img-3.jpg') }}"alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/small/img-3.jpg') }}"alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center">
                                        <h4 class="card-title">Homepage</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row gallery-wrapper">
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Sales</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Accounting</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Customer Care</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Designer</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Production</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Packaging</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Admin Production</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="element-item col-xl-3 col-sm-6 project designing development" data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" href="{{ route('login') }}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{ asset('assets/images/homepage.jpg') }}" alt="" />
                                                                    <div class="gallery-overlay"></div>
                                                                </a>
                                                            </div>
            
                                                            <div class="box-content p-3">
                                                                <h5 class="title">Delivery</h5>
                                                                <p class="post">&nbsp; <a href="" class="text-body"></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- ene card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
@endsection

@section('script-auth')
@endsection
