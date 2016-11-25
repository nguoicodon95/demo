<?php
	namespace Repositories;

	use App\Models\Amenities;
	use Repositories\BaseRepository as BaseRepository;

	class AmenitiesRepository extends BaseRepository {
		public function model()
		{
			return Amenities::class;
		}
	}

?>