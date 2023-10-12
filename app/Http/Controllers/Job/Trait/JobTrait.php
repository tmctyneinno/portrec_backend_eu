<?php

namespace App\Http\Controllers\Job\Trait;

trait JobTrait
{
	public $jc = "jobs as total_jobs";

	private function filter($query, $table, $delimeter, $pointer = "id"): void
	{
		if ($delimeter)
			$query->whereHas($table, function ($query) use ($delimeter, $pointer) {
				$query->whereIn($pointer, [$delimeter]);
			});
	}
}
