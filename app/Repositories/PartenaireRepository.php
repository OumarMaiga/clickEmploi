<?php

    namespace App\Repositories;

    use App\Models\User;

    class PartenaireRepository extends ResourceRepository {

        public function __construct(User $user) {
            $this->model = $user;
        }
        
    }