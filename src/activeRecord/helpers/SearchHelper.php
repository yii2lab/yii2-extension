<?php

namespace yii2lab\extension\activeRecord\helpers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii2lab\domain\data\Query;

class SearchHelper {
	
	const SEARCH_TEXT_MIN_LENGTH = 3;
	const SEARCH_PARAM_NAME = 'search-text';
	
	public static function extractSearchTextFromQuery(Query $query) {
		$searchText = $query->getWhere(self::SEARCH_PARAM_NAME);
		$query->removeWhere(self::SEARCH_PARAM_NAME);
		$searchText = trim($searchText);
		return $searchText;
	}
	
	public static function appendSearchCondition(Query $query, $searchByTextFields, $searchText) {
		self::validateSearchText($searchText);
		$likeCondition = self::generateLikeCondition($searchText, $searchByTextFields);
		$query->andWhere($likeCondition);
	}
	
	private static function generateLikeCondition($text, $searchByTextFields) {
		if(empty($searchByTextFields)) {
			throw new InvalidArgumentException('Method "searchByTextFields" return empty array!');
		}
		$q = Query::forge();
		foreach($searchByTextFields as $key) {
			$q->orWhere(['ilike', $key, $text]);
		}
		return $q->getParam('where');
	}
	
	private static function validateSearchText($text) {
		$text = trim($text);
		if(empty($text) || mb_strlen($text) < self::SEARCH_TEXT_MIN_LENGTH) {
			throw new BadRequestHttpException(Yii::t('yii', '{attribute} should contain at least {min, number} {min, plural, one{character} other{characters}}.', [
				'attribute'=>self::SEARCH_PARAM_NAME,
				'min'=>self::SEARCH_TEXT_MIN_LENGTH,
			]));
		}
	}
	
}