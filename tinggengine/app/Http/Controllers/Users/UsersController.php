<?php

namespace App\Http\Controllers\Users;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsersController extends Controller
{
		public function create(){
			echo json_encode("Add New User");
		}


		public function update(){
			echo json_encode("Add New User");
		}
		
		public function get(){
			echo json_encode("Add New User");
		}

		public function list(){
			echo json_encode("Add New User");
		}

		public function archive(){
			echo json_encode("Add New User");
		}
		

}
?>