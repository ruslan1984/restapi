<?
namespace AV;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApi{
	private $method;
	function __construct(){
		$this->method 	=	\AV\RestApiBase::getMethod();
		self::getRestMethod();
	}
	/*
	 *	Выбор необходимого метода
	 */
	private function getRestMethod(){
		switch ($this->method){
			case 'GET':{
				new \AV\RestApiGETMethods();
				break;
			}
			case 'POST':{
				new \AV\RestApiPOSTMethods();
				break;
			}
			default:{
				\AV\RestApiBase::getResponseText();
			}
		}
	}

	/*
		Оочистка кэша приобновлении элемента
		*/
	function OnAfterIBlockRestElementUpdateHandler(&$arFields)
	{
		//$iblockClearCacheId[] =	$arFields['IBLOCK_ID'];
		//$cacheDir =	Setting::REST_CACHE_DIR;
		//$clearCacheDir	=	"$cacheDir/$iblockId/";
		$cacheFullPath	=	$_SERVER['DOCUMENT_ROOT']."/bitrix/cache/restapi_cache/";		
		BXClearCache(true, "/restapi_cache/");
		if(file_exists($cacheFullPath)){
			BXClearCache(true, "/restapi_cache/");
		//	$cache = \Bitrix\Main\Data\Cache::createInstance();
		//	$cache->cleanDir($cacheFullPath);		
		}
	}
}