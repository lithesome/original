<?php

	namespace Controllers\__controller_ns__\Models;

	use Core\Classes\Database\Model as ParentModel;
	use Core\Interfaces\Database\Table;

	/**
	 * Class __model__
	 * @package Controllers\__controller_ns__
	 * @property Table $__controller_c__
	 * @method static |Table __controller_c__(...$other_tables)
	 */
	class __model__ extends ParentModel
	{
		protected $table = '__controller_c__';        // Корневой ключ кеша

		public function __construct()
		{
			parent::__construct();
		}

		public function dropTable()
		{
			return $this->__controller_c__->drop()->exec();
		}

		public function makeTable()
		{
			return $this->__controller_c__->make(array(
				'id' => 'bigint(20) unsigned auto_increment',
				'status' => 'tinyint(1) not null default ' . STATUS_ACTIVE,
				'date_add' => 'bigint(20) null default null',
				'date_upd' => 'bigint(20) null default null',
				'date_del' => 'bigint(20) null default null',
			), array(
				'id' => 'primary key',
				'status' => 'index',
				'date_add' => 'index',
				'date_upd' => 'index',
				'date_del' => 'index',
			))->exec();
		}

		/**
		 * Подсчитать количество всех записей
		 * @return integer
		 */
		public function count__controller_cu__Items()
		{
			return $this->__controller_c__->select('count(id) as total')
				->query('status = :status')
				->prepare(':status', STATUS_ACTIVE)
				->exec()
				->one(false)->total;
		}

		/**
		 * Получить список всех записей
		 * @return array
		 */
		public function get__controller_cu__Items()
		{
			return $this->__controller_c__->select()
				->query('status = :status')
				->prepare(':status', STATUS_ACTIVE)
				->exec()
				->all();
		}

		/**
		 * Получить одну запись по ID
		 * @param $id
		 * @return array|object
		 */
		public function get__controller_cu__ItemById($id)
		{
			return $this->__controller_c__->select()
				->query('id = :id and status = :status')
				->prepare(':id', $id)
				->prepare(':status', STATUS_ACTIVE)
				->exec()
				->one();
		}

		/**
		 * Добавить новую запись
		 * @return string
		 */
		public function add__controller_cu__Item()
		{
			return $this->__controller_c__->insert('date_add', time())
				->orUpdate('date_upd', time())
				->exec()
				->id();
		}

		/**
		 * Обновить запись по ID
		 * @param $id
		 * @return string
		 */
		public function update__controller_cu__Item($id)
		{
			return $this->__controller_c__->update('date_upd', time())
				->query('id = :id')
				->prepare(':id', $id)
				->exec()
				->rows();
		}

		/**
		 * Удалить запись по ID
		 * @param $id
		 * @return string
		 */
		public function delete__controller_cu__Item($id)
		{
			return $this->__controller_c__->update('status', STATUS_DELETED)
				->update('date_del', time())
				->query('id = :id')
				->prepare(':id', $id)
				->exec()
				->rows();
		}
	}