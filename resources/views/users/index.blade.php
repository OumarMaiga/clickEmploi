<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 align-items-start content-title">
                    LES UTILISATEURS
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prenom & Nom</th>
                    <!--<th scope="col">Telephone</th>
                    <th scope="col">E-mail</th>-->
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
                            $diplome = $user->diplome()->get();
                            $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
                        ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $user->prenom." ".$user->prenom }}</td>
                            <!--<td>{{ $user->telephone }}</td>
                            <td>{{ $user->email }}</td>-->
                            <td>
                                @foreach ($domaines as $domaine)
                                    {{ " - ".$domaine->libelle }}    
                                @endforeach
                            </td>
                            <td>{{ $diplome->libelle }}</td>
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
        </div>
    </div>
</x-dashboard-layout>