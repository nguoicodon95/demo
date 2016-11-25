<?php
	namespace Repositories;

	use Closure;
	use Exception;
	use Illuminate\Container\Container as Application;
	use Illuminate\Contracts\Pagination\LengthAwarePaginator;
	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Support\Collection;

	abstract class BaseRepository implements RepositoryInterface {
		protected $app;
		protected $model;
		protected $fieldSearchable = array();
		protected $scopeQuery = null;

		public function __construct(Application $app) {
			$this->app = $app;
			$this->makeModel();
			$this->boot();
		}

		public function boot() {}

		abstract public function model();

		public function makeModel() {
			$model = $this->app->make($this->model());
			if(!$model instanceof Model) {
				throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
			}
			return $this->model = $model;
		}
		
		public function getFieldsSearchable() {
			return $this->fieldSearchable;
		}
		
		public function scopeQuery(\Closure $scope) {
			$this->scopeQuery = $scope;
			return $this;
		}

		public function all($columns = array('*')) {
			$results = $this->model->get($columns);
			return $results;
		}

		public function paginate($limit = null, $columns = array('*'))
		{}

		public function find($id, $columns = array('*'))
		{
	        $results = $this->model->findOrFail($id, $columns);
	        return $results;
		}

		public function findByField($field, $value = null, $columns = array('*'))
		{
		    return $this->model->where($field, '=', $value)->first($columns);
		}

		public function findWhere( array $where , $columns = array('*'))
		{}

		public function findWhereIn( $field, array $values, $columns = array('*'))
		{}

		public function findWhereNotIn( $field, array $values, $columns = array('*'))
		{}

		public function create(array $attributes)
		{
			return $this->model->create($attributes);
		}

		public function update(array $attributes, $id)
		{
			$row = $this->model->find($id);

			return $row->update($attributes);

		}

		public function delete($id)
		{
			return $this->model->destroy($id);
		}

		public function with(array $relations)
		{
			$this->model = $this->model->with($relations);
			return $this;
		}

	}
?>