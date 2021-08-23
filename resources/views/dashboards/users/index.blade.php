<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 d-flex align-items-center content-title">
                    LES UTILISATEURS
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="GET" action="{{ route('user.filter') }}">
                <div class="container form-row justify-content-end mb-4">
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
                    <button type="submit" id="filtre-btn" class="btn btn-outline-custom">
                        {{ __('FILTRER') }}
                    </button>
                </div>
                <table class="table table-hover table-responsive">
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
                                $activites = $user->activites()->get();
                                $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
                                $annee_experience = $user->annee_experience;
                                if ($annee_experience == "0.5") {
                                    $annee_experience = "6 mois";
                                }elseif($annee_experience == "1") {
                                    $annee_experience = "1 an";
                                }elseif($annee_experience == "2") {
                                    $annee_experience = "2 ans";
                                }elseif($annee_experience == "3") {
                                    $annee_experience = "3 ans";
                                }elseif($annee_experience == "4") {
                                    $annee_experience = "4 ans";
                                }elseif($annee_experience == "5") {
                                    $annee_experience = "5 ans";
                                }else{
                                    $annee_experience = "";
                                }
                            ?>
                            <tr>
                                <th scope="row">{{ $n }}</th>
                                <td>{{ "$user->prenom $user->nom" }}</td>
                                <td>{{ $activites->implode('libelle', ', ') }}</td>
                                <td>{{ $diplome != null ? $diplome->libelle : "" }}</td>
                                <td>{{ $annee_experience }}</td>
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
                <a class="btn btn-custom"href="{{ route('export') }}">Exporter les données en Excel</a>
            </form>
        </div>
    </div>
</x-dashboard-layout>