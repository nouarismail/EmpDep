<?php

return [
    
    'per_page' => env('API_PER_PAGE', 15),

    
    'min' => 1,
    'max' => env('API_PER_PAGE_MAX', 100),
];
