<?php

namespace App\Controllers;

use App\Core\View;

class Home {
    public function index($params) {
        View::render("home/index.html");        
    }
}