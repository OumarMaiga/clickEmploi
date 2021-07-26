<?php

    namespace App\Repositories;

    use App\Models\Diplome;

    class DiplomeRepository extends ResourceRepository {

        public function __construct(Diplome $diplome) {
            $this->model = $diplome;
        }

    }