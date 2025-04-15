@props(['popups'])

<div class="modal fade" id="popupCarouselModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md custom-modal">
        <div class="modal-content position-relative bg-transparent">
            <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            <div id="popup-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($popups as $item)
                        <div @class(['carousel-item', 'active' => $loop->index == 0]) data-bs-interval="4000">
                            <img src="{{ $item['imagen'] }}" class="d-block w-100">
                            <div class="position-absolute bottom-0 w-100 p-1">
                                @if ($item['url_destino'])
                                    <a href="{{ $item['url_destino'] }}"
                                        target="{{ $item['nueva_pestana'] ? '_blank' : '' }}"
                                        class="btn btn-success text-white d-block w-100">{{ $item['titulo'] }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#popup-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#popup-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        const segundos = Math.trunc(1 + Math.random() * 4) * 1000;
        const modal = new window.bootstrap.Modal(document.getElementById("popupCarouselModal"));

        setTimeout(() => {
            modal.show();
        }, segundos);
    }
</script>

<style>
    .custom-modal {
        border: 2px dashed #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .btn-close-modal {
        background-color: #7aa815;
        border: 1px solid #fff;
        opacity: 1;
        padding: 8px;
        position: absolute;
        z-index: 10;
        top: 2px;
        right: 2px;
    }
</style>
