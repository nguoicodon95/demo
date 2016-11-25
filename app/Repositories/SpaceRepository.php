<?php
	namespace Repositories;

	use App\Models\Space;
	use Repositories\BaseRepository as BaseRepository;

	class SpaceRepository extends BaseRepository {
		public function model()
		{
			return Space::class;
		}
	}

?>