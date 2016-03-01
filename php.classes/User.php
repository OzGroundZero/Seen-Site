<?php 
	class User {
		var $id;
		var $username;

		var $fName;
		var $lName;
		var $friends;

		function User($id, $u, $fName, $lName) {
			$this->id = $id;
			$this->username = $u;

			$this->fName = $fName;
			$this->lName = $lName;
		}

	}
?>