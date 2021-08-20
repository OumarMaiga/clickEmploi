<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 align-items-start content-title">
                    LES ABONNEES
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type d'abonnement</th>
                    <th scope="col">Abonnée</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($abonnees as $abonnee)
                        <?php
                            $n = $n + 1;
                            $user = $abonnee->user()->associate($abonnee->user_id)->user;
                            $prenom = $user->prenom;
                            $nom = $user->nom;
                            $email = $user->email;
                            $user = $prenom." ".$nom;
                            
                            if (empty($prenom) && empty($nom)){
                                $user = $email;
                            }

                        ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $abonnee->type }}</td>
                            <td>{{ $user }}</td>
                            <td>
                                @if ($abonnee->etat == true)
                                    <span class="btn btn-success">Active</span>
                                @else
                                    <span class="btn btn-danger">Non active</span>
                                @endif
                            </td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('abonnee.show', $abonnee->id) }}" class="col icon-action detail">
                                    <span class="fas fa-info">
                                    </span>
                                </a>
                                <span class="col icon-action">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['abonnee.destroy', $abonnee->id], 'class' => 'd-inline-flex']) !!}
                                            <button class="" type="submit" onclick="confirm('Vraiment supprimer cet utilisateur ?')">
                                                <span class="fas fa-user-times supp"></span>
                                            </button>
                                            {!! Form::submit('', ['class' => '', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                        
                                    {!! Form::close() !!}
                                </span>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>