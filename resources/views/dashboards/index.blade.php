<x-dashboard-layout>
    <div class="dashboard-content">
        @if (Session::has('welcome'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:1.4rem;">
                {!! Session::get('welcome', 'Bienvenue'); !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Auth::user()->type == "admin")
            <div class="nbre-user">
                <div class="nbre">
                    {{ $nbre_users }}
                </div>
                <div class="user">
                    Utilisateurs
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Abonnées
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_abonnees }}
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Offres en cours
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_offres_en_cours }}
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Partenaires
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_partenaires }}
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Mes offres
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_mes_offres }}
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Mes offres en cours
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_mes_offres_en_cours }}
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 dashboard-index-item">
                    <span class="left-bar"></span>
                    <div class="dashboard-index-lil-title">
                        Postulants
                    </div>
                    <div class="dashboard-index-lil-nbre">
                        {{ $nbre_postulants }}
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-6">
            <h4 class="dashboard-index-subtitle">Mes offres</h4>
            <table class="table table-hover">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Durée</th>
                    <th scope="col">Type</th>
                    <th scope="col">Postulants</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($mes_offres as $offre)
                        <?php 
                            $n = $n + 1;
                            $nbre_postulants = App\Models\Postule::where('opportunite_id', $offre->id)->get()->count();
                        ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $offre->title }}</td>
                            <td>{{ $offre->duree }}</td>
                            <td>{{ $offre->type }}</td>
                            <td>{{ $nbre_postulants }}</td>
                            <td>
                                @switch($offre->type)
                                    @case('emploi')
                                        <a href="{{ route('emploi.show', $offre->slug) }}" class="col icon-action detail">
                                            <span class="fas fa-info">
                                            </span>
                                        </a>
                                        <a href="{{ route('emploi.edit', $offre->slug) }}" class="col icon-action icon-edit">
                                            <span class="fas fa-user-edit edit">
                                            </span>
                                        </a>
                                        <span class="col icon-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['emploi.destroy', $offre->id], 'class' => 'd-inline-flex']) !!}
                                                <button class="" type="submit" onclick="return confirm('Vraiment supprimer cette offre ?')">
                                                    <span class="fas fa-trash-alt supp"></span>
                                                </button>
                                            {!! Form::close() !!}
                                        </span>
                                        @break
                                    @case('stage')
                                        <a href="{{ route('stage.show', $offre->slug) }}" class="col icon-action detail">
                                            <span class="fas fa-info">
                                            </span>
                                        </a>
                                        <a href="{{ route('stage.edit', $offre->slug) }}" class="col icon-action icon-edit">
                                            <span class="fas fa-user-edit edit">
                                            </span>
                                        </a>
                                        <span class="col icon-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['stage.destroy', $offre->id], 'class' => 'd-inline-flex']) !!}
                                                <button class="" type="submit" onclick="return confirm('Vraiment supprimer cette offre ?')">
                                                    <span class="fas fa-trash-alt supp"></span>
                                                </button>
                                            {!! Form::close() !!}
                                        </span>
                                        @break
                                    @case('formation')
                                        <a href="{{ route('formation.show', $offre->slug) }}" class="col icon-action detail">
                                            <span class="fas fa-info">
                                            </span>
                                        </a>
                                        <a href="{{ route('formation.edit', $offre->slug) }}" class="col icon-action icon-edit">
                                            <span class="fas fa-user-edit edit">
                                            </span>
                                        </a>
                                        <span class="col icon-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['formation.destroy', $offre->id], 'class' => 'd-inline-flex']) !!}
                                                <button class="" type="submit" onclick="return confirm('Vraiment supprimer cette offre ?')">
                                                    <span class="fas fa-trash-alt supp"></span>
                                                </button>
                                            {!! Form::close() !!}
                                        </span>
                                        @break
                                    @default
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>