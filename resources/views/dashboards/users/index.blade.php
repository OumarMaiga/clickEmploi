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
            </form>
            
            @include('dashboards.users.table')
            <a class="btn btn-warning float-right" href="{{ route('export') }}">Export User Data</a>
        </div>
    </div>
</x-dashboard-layout>