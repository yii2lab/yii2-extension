<?php

namespace yii2lab\extension\web\helpers;

use yii\filters\Cors;
use yii2lab\extension\web\enums\HttpHeaderEnum;
use yii2lab\extension\web\enums\HttpMethodEnum;

class CorsHelper {
	
	public static function generate($origin = null) {
		/*if(empty($origin)) {
			$origin = self::generateOriginFromEnvUrls();
		}*/
		return [
			'class' => Cors::class,
			'cors' => [
				'Origin' => ['*'],
				'Access-Control-Request-Method' => [
					HttpMethodEnum::GET,
					HttpMethodEnum::POST,
					HttpMethodEnum::PUT,
					HttpMethodEnum::DELETE,
					HttpMethodEnum::OPTIONS,
					HttpMethodEnum::HEAD,
					HttpMethodEnum::PATCH,
					HttpMethodEnum::TRACE,
					HttpMethodEnum::CONNECT,

				],
				'Access-Control-Request-Headers' => [
					HttpHeaderEnum::CONTENT_TYPE,
					HttpHeaderEnum::X_REQUESTED_WITH,
					HttpHeaderEnum::AUTHORIZATION,
					HttpHeaderEnum::TIME_ZONE,
				],
				'Access-Control-Expose-Headers' => [
					HttpHeaderEnum::LINK,
					HttpHeaderEnum::ACCESS_TOKEN,
					HttpHeaderEnum::AUTHORIZATION,
					HttpHeaderEnum::TIME_ZONE,
					HttpHeaderEnum::TOTAL_COUNT,
					HttpHeaderEnum::PAGE_COUNT,
					HttpHeaderEnum::CURRENT_PAGE,
					HttpHeaderEnum::PARTNER_NAME,
					HttpHeaderEnum::PARENT,
					HttpHeaderEnum::PER_PAGE,
					HttpHeaderEnum::LANGUAGE,
				],
				//'Access-Control-Allow-Credentials' => true,
				//'Access-Control-Max-Age' => 3600, // Allow OPTIONS caching
			],
		];
	}
	
	private static function generateOriginFromEnvUrls() {
		$origin = [];
		$urls = env('url');
		foreach($urls as $url) {
			$origin[] = trim($url, SL);
		}
		return $origin;
	}
	
}
