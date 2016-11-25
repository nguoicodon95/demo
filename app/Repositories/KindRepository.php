<?php
	namespace Repositories;

	use App\Models\Kind;
	use Repositories\BaseRepository as BaseRepository;

	class KindRepository extends BaseRepository {
		public function model()
		{
			return Kind::class;
		}
	}

?>