<?php

namespace yii2lab\extension\arrayTools\traits;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\helpers\repository\QueryFilter;
use yii2lab\domain\traits\repository\ReadOneTrait;
use yii2lab\extension\arrayTools\helpers\ArrayIterator;
use yii2lab\domain\data\Query;
use yii\web\NotFoundHttpException;
use yii2lab\domain\Domain;
use yii2lab\domain\helpers\repository\RelationHelper;
use yii2lab\domain\helpers\repository\RelationWithHelper;

/**
 * Trait ArrayReadTrait
 *
 * @package yii2lab\extension\arrayTools\traits
 *
 * @property string $id
 * @property string $primaryKey
 * @property Domain $domain
 */
trait ArrayReadTrait {

	use ReadOneTrait;
	
	abstract public function forgeEntity($data, $class = null);
	abstract protected function getCollection();
	
	public function relations() {
		return [];
	}
	
	public function all(Query $query = null) {
		$query = $this->prepareQuery($query);
		
		$queryFilter = Yii::createObject([
			'class' => QueryFilter::class,
			'repository' => $this,
			'query' => $query,
		]);
		$queryWithoutRelations = $queryFilter->getQueryWithoutRelations();
		
		$iterator = $this->getIterator();
		$array = $iterator->all($queryWithoutRelations);
		$collection = $this->forgeEntity($array);
		
		$collection = $queryFilter->loadRelations($collection);
		return $collection;
	}
	
	public function count(Query $query = null) {
		$query = Query::forge($query);
		$iterator = $this->getIterator();
		return $iterator->count($query);
	}

	private function getIterator() {
		$collection = $this->getCollection();
		$iterator = new ArrayIterator();
		$iterator->setCollection($collection);
		return $iterator;
	}
	
}