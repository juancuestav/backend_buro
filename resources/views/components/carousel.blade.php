<div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="6000">
            <img src="img/carousel/slide1.png" class="d-block w-100 alto-imagen" alt="..." style="object-fit: fill;">
        </div>
        <div class="carousel-item" data-bs-interval="6000">
            <img src="img/carousel/slide0.jpeg" class="d-block w-100 alto-imagen" alt="..." style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bs-interval="6000">
            <img src="img/carousel/slide2.jpeg" class="d-block w-100 alto-imagen" alt="..." style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bs-interval="6000">
            <img src="img/carousel/slide3.jpg" class="d-block w-100 alto-imagen" alt="..." style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bs-interval="6000">
            <img src="img/carousel/slide4.jpg" class="d-block w-100 alto-imagen" alt="..." style="object-fit: cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        {{-- <span class="visually-hidden">Next</span> --}}
    </button>
</div>

<style>
    @media (min-width: 576px) {
        .alto-imagen {
            height: 240px;
        }
    }

    @media (min-width: 768px) {
        .alto-imagen {
            height: 380px;
        }
    }

    @media (min-width: 992px) {
        .alto-imagen {
            height: 540px;
        }
    }

    @media (min-width: 1200px) {
        .alto-imagen {
            height: 620px;
        }
    }

    @media (min-width: 1400px) {
        .alto-imagen {
            height: 700px;
        }
    }

    @media (min-width: 1920px) {
        .alto-imagen {
            height: 950px;
        }
    }

</style>
