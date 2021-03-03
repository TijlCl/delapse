<?php
namespace App\Http\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface RepositoryInterface
{
/**
 * @param array $attributes
 * @return Model
 */
public function create(array $attributes): Model;

/**
 * @param $id
 * @return Model
 */
public function find($id): ?Model;


/**
 * @return Collection
 */
public function all(): Collection;
}
