<?php

	namespace Controllers\Home;

	use Core\Classes\Database\Model as ParentModel;
	use Core\Interfaces\Database\Table;

	/**
	 * Class Model
	 * @package Controllers\Home
	 * @property Table $home
	 * @method static |Table home(...$other_tables)
	 */
	class Model extends ParentModel
	{
		protected $table = 'home';

		public function __construct()
		{
			parent::__construct();
		}
	}