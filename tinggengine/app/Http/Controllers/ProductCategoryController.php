<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;

class ProductCategoryController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        
    }

    public function get(Request $request, $id) {
        
    }

    public function save(Request $request) {
        
    }

    public function update(Request $request) {
        
    }

    public function archive(Request $request, $id) {
        
    }

}
