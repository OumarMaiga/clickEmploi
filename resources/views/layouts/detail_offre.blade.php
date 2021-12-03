<div class="side-block-offre">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ photo_entreprise($opportunite->entreprise_id) }}" alt="Photo de l'entreprise" class="side-block-offre-image">
        </div>
        <div class="col-md-8">
            <div class="side-block-offre-title">
                {{ $opportunite->title }}
            </div>
            <div class="side-block-entreprise">
                <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a>
            </div>
            <div class="side-block-lieu">
                <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
            </div>
            <div class="side-block-btn-postule">
                <a href="#postuler" class="btn btn-outline-custom">Postulez</a>
            </div>
        </div>
    </div>
</div>