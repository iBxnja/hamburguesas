@extends('web.plantilla')
@section('contenido')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="web/img/burger1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Las mejores hamburguesas Colombo-Argentinas</h1>
                                    <a href="/take-away" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Menú del día</a>
                                    <a href="#sucursales" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Sucursales</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="web/img/burger2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Mejores que Mc Donalds</h1>
                                    <a href="/take-away" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Menú del día</a>
                                    <a href="#sucursales" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Sucursales</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Feature Start -->
    <div class="container-fluid bg-light my-5 py-6">
        <div class="container">
            <div id="sucursales" class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Visita nuestras sucursales o pide a domicilio</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="web/img/burgerarg1.jpg" alt="">
                        <h4 class="mb-3">Buenos Aires</h4>
                        <p class="mb-4">Calle falsa 123</p>
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="">Ver más</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="web/img/burgercol1.jpg" alt="">
                        <h4 class="mb-3">Medellín</h4>
                        <p class="mb-4">Centro comercial Santafé</p>
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
  
    @endsection