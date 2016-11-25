<?php
	namespace Repositories;

	use App\Models\BedType;
	use Repositories\BaseRepository as BaseRepository;

	class BedTypeRepository extends BaseRepository {
		public function model()
		{
			return BedType::class;
		}
	}

?>