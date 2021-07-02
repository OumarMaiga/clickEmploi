<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 align-items-start content-title">
                    LES UTILISATEURS
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="GET" action="{{ route('user.filter') }}">
                <div class="form-row justify-content-end mb-4">
                    <div class="col-lg-2 col-md-3">
                        <select name="secteur" id="secteur" class="custom-select">
                            <option value="">-- Domaine --</option>
                            @foreach ($secteurs as $secteur)
                                @if (isset($_GET['secteur']))
                                    <option <?= ($_GET['secteur'] == $secteur->slug) ? "selected=selected" : "" ?> value="{{ $secteur->slug }}">{{$secteur->libelle }}</option>
                                @else
                                    <option value="{{ $secteur->slug }}">{{$secteur->libelle }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <select name="diplome" id="diplome" class="custom-select">
                            <option value="">-- Niveau d'étude --</option>
                            @foreach ($diplomes as $diplome)
                                @if (isset($_GET['secteur']))
                                    <option <?= ($_GET['diplome'] == $diplome->slug) ? "selected=selected" : "" ?> value="{{$diplome->slug }}">{{$diplome->libelle }}</option>
                                @else
                                <option value="{{$diplome->slug }}">{{$diplome->libelle }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-custom">
                        {{ __('FILTRER') }}
                    </button>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Prenom & Nom</th>
                            <th scope="col">Domaine d'activité</th>
                            <th scope="col">Niveau d'étude</th>
                            <th scope="col">Durée d'experience</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($users as $user)
                            <?php 
                                $n = $n + 1;
                                $domaines = $user->domaines()->get();
                                $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
                            ?>
                            <tr>
                                <th scope="row">{{ $n }}</th>
                                <td>{{ $user->nom." ".$user->prenom }}</td>
                                <td>{{ $domaines->implode('libelle', ', ') }}</td>
                                <td>{{ $diplome != null ? $diplome->libelle : "" }}</td>
                                <td>{{ $user->experience_professionnel }}</td>
                                <td class="justify-content-between icon-content">
                                    <a href="{{ route('user.show', $user->email) }}" class="col icon-action detail">
                                        <span class="fas fa-info">
                                        </span>
                                    </a>                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a class="btn btn-warning float-right" href="{{ route('exportCustom') }}">Export User Data Custom</a>
                <a class="btn btn-warning float-right" href="{{ route('export') }}">Export User Data</a>
            </form>
        </div>
    </div>
</x-dashboard-layout>