<?php

namespace yii2lab\extension\web\enums;

use yii2lab\extension\enum\base\BaseEnum;

class HttpHeaderEnum extends BaseEnum {
	
	const LINK = 'link';
	const TOTAL_COUNT = 'X-Pagination-Total-Count';
	const PAGE_COUNT = 'X-Pagination-Page-Count';
	const CURRENT_PAGE = 'X-Pagination-Current-Page';
	const PER_PAGE = 'X-Pagination-Per-Page';
	const TIME_ZONE = 'Time-Zone';
	const CONTENT_TYPE = 'Content-Type';
	const AUTHORIZATION = 'Authorization';
	const ACCESS_TOKEN = 'access-token';
	const X_REQUESTED_WITH = 'X-Requested-With';
	const LANGUAGE = 'language';
	const PARTNER_NAME = 'partner-name';
	const PARENT = 'parent';
	const IP_ADDRESS = 'ip-address';
	const USER_AGENT = 'user-agent';

}
