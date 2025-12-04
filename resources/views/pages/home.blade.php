@extends('layouts.public')

@section('content')
    <section class="head-bg" aria-label="Sección principal de cambio">
        <svg class="bg-pattern" viewBox="0 0 360 360" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
             focusable="false">
            <defs>
                <pattern id="dots" x="0" y="0" width="11.1" height="11.1" patternUnits="userSpaceOnUse">
                    <circle cx="1" cy="1" r="1.5" fill="#0050FF" />
                </pattern>
            </defs>
            <rect width="360" height="360" fill="url(#dots)" />
        </svg>

        <div class="head-content">
            <h1 class="head-title">El cambio comienza aquí<span class="text-danger">.</span></h1>
            <p class="head-subtitle">Únete a <strong>612.435.820</strong> personas que están impulsando un cambio real en sus
                comunidades.</p>

            <div class="d-flex justify-content-center gap-3 flex-wrap" role="group"
                 aria-label="Botones para crear petición o iniciar con IA">
                <button class="btn btn-yellow" type="button" onclick="window.location.href = './makeapetition.html'">Crear una petición</button>
                <button class="btn btn-outline-dark-custom" type="button">Comenzar con IA</button>
            </div>
        </div>

        <div class="circles-wrapper d-none d-md-flex" aria-label="Imágenes de victorias y tendencias" role="list">
            <div class="circles-col left">
                <div class="circle-single" role="listitem" onclick="window.location.href = './peticion.html'">
                    <img src="../assets/img/foto.png" alt="Imagen Cabecera 1" />
                    <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                    <div class="circle-subtext">162.304 firmas</div>
                </div>
                <div class="circle-single" role="listitem">
                    <img src="../assets/img/foto.png" alt="Imagen Cabecera 2" />
                    <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                    <div class="circle-subtext">89.177 firmas</div>
                </div>
            </div>
            <div class="circles-col right">
                <div class="circle-single" role="listitem" onclick="window.location.href = './peticion.html'">
                    <img src="../assets/img/foto.png" alt="Imagen Cabecera 3" />
                    <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                    <div class="circle-subtext">175.291 firmas</div>
                </div>
                <div class="circle-single" role="listitem" onclick="window.location.href = './peticion.html'">
                    <img src="../assets/img/foto.png" alt="Imagen Cabecera 4" />
                    <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                    <div class="circle-subtext">201.558 firmas</div>
                </div>
            </div>
            <div class="circle-center" role="listitem" onclick="window.location.href = './peticion.html'">
                <img src="../assets/img/foto.png" alt="Imagen Cabecera 5" />
                <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                <div class="circle-subtext">138.920 firmas</div>
            </div>
        </div>

        <div id="headCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#headCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                        aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#headCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#headCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#headCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#headCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>

            <div class="carousel-inner pt-5 pb-4 text-center">

                <div class="carousel-item active">
                    <div class="circle-single-carousel">
                        <img src="../assets/img/foto.png" alt="Imagen Cabecera 1" />
                        <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                        <div class="circle-subtext">162.304 firmas</div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="circle-single-carousel">
                        <img src="../assets/img/foto.png" alt="Imagen Cabecera 2" />
                        <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                        <div class="circle-subtext">89.177 firmas</div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="circle-single-carousel">
                        <img src="../assets/img/foto.png" alt="Imagen Cabecera 3" />
                        <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                        <div class="circle-subtext">175.291 firmas</div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="circle-single-carousel">
                        <img src="../assets/img/foto.png" alt="Imagen Cabecera 4" />
                        <div class="circle-label"><span class="dot"></span>En tendencia</div>
                        <div class="circle-subtext">201.558 firmas</div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="circle-single-carousel">
                        <img src="../assets/img/foto.png" alt="Imagen Cabecera 5" />
                        <div class="circle-label"><span class="dot"></span>¡Victoria!</div>
                        <div class="circle-subtext">138.920 firmas</div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#headCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#headCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
@endsection
