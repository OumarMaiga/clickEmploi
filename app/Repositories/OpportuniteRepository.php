<?php

    namespace App\Repositories;

    use App\Models\Opportunite;

    class OpportuniteRepository extends ResourceRepository {

        public function __construct(Opportunite $opportunite) {
            $this->model = $opportunite;
        }
        
    }