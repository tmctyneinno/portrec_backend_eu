<?php

namespace App\Http\Controllers\Job\Trait;

trait JobTrait
{
	public $jc = "jobs as total_jobs";

	private function filter($query, $relationship, $delimeter, $pointer = "id"): void
	{
		if ($delimeter)
			$query->whereHas($relationship, function ($query) use ($delimeter, $pointer) {
				$query->whereIn($pointer, [$delimeter]);
			});
	}
}
