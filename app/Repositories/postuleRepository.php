<?php


    namespace App\Repositories;

    use App\Models\Postule;

    class PostuleRepository extends ResourceRepository {
        
        public function __construct(Postule $postule) {
            $this->model = $postule;
        }
    
    }