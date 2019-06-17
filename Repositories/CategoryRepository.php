<?php

namespace Modules\Itest\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CategoryRepository extends BaseRepository
{
 public function whereQuiz($id);
}
