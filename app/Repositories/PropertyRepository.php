<?php
	namespace Repositories;

	use App\Models\Property;
	use Repositories\BaseRepository as BaseRepository;

	class PropertyRepository extends BaseRepository {
		public function model()
		{
			return Property::class;
		}
	}

?>