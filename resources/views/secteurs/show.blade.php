<x-dashboard-layout>
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
                <img alt="profil" src="" class="profil-img"/>
                <div class="mt-4 row">
                    <a href="{{ route('partenaire.edit', $partenaire->email) }}"> <button class="ml-4 btn btn-outline-warning">MODIFIER</button></a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['partenaire.destroy', $partenaire->id]]) !!}
                        {!! Form::submit('RETIRER', ['class' => 'ml-2 btn btn-outline-danger', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="profil-name">
                    {{ $partenaire->prenom." ".$partenaire->nom }}
                </div>
                <div class="profil-email">
                    {{ $partenaire->email }}
                </div>
                <div class="profil-description">
                    Tel: {{ $partenaire->telephone }}
                </div>
                <div class="profil-description">
                    Adresse: {{ $partenaire->adresse }}
                </div>
                <div class="profil-description">
                    Secteur d'activité: Design, Economie, Football
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col text-center">
                        <h6 class="subtitle">Emploi publié</h6>
                        <p class="number">2</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Formation publiée</h6>
                        <p class="number">1</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Stage publié</h6>
                        <p class="number">5</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
