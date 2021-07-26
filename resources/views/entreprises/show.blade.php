<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="row">
                <div class="col-md-4">
                    <img alt="profil" src="" class="profil-img"/>
                    <div class="mt-4 row">
                        <a href="{{ route('entreprise.edit', $entreprise->slug) }}"> <button class="ml-4 btn btn-outline-warning">MODIFIER</button></a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['entreprise.destroy', $entreprise->id]]) !!}
                            {!! Form::submit('RETIRER', ['class' => 'ml-2 btn btn-outline-danger', 'onclick' => 'return confirm(\'Vraiment supprimer cet entreprise ?\')']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profil-name">
                        {{ $entreprise->libelle }}
                    </div>
                    <div class="profil-email">
                        {{ $entreprise->email }}
                    </div>
                    <div class="profil-description">
                        Tel: {{ $entreprise->telephone }}
                    </div>
                    <div class="profil-description">
                        Adresse: {{ $entreprise->adresse }}
                    </div>
                    <div class="profil-description">
                        Secteur d'activité: Design, Economie, Football
                    </div>
                    <div class="mt-4">
                        <h3 class="qui">Qui sommes nous ?</h3>
                         {{ $entreprise->description }}
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
    </div>
</x-dashboard-layout>
