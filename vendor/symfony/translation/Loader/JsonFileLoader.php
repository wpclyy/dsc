<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Loader;

class JsonFileLoader extends FileLoader
{
	protected function loadResource($resource)
	{
		$messages = array();

		if ($data = file_get_contents($resource)) {
			$messages = json_decode($data, true);

			if (0 < ($errorCode = json_last_error())) {
				throw new \Symfony\Component\Translation\Exception\InvalidResourceException(sprintf('Error parsing JSON - %s', $this->getJSONErrorMessage($errorCode)));
			}
		}

		return $messages;
	}

	private function getJSONErrorMessage($errorCode)
	{
		switch ($errorCode) {
		case JSON_ERROR_DEPTH:
			return 'Maximum stack depth exceeded';
		case JSON_ERROR_STATE_MISMATCH:
			return 'Underflow or the modes mismatch';
		case JSON_ERROR_CTRL_CHAR:
			return 'Unexpected control character found';
		case JSON_ERROR_SYNTAX:
			return 'Syntax error, malformed JSON';
		case JSON_ERROR_UTF8:
			return 'Malformed UTF-8 characters, possibly incorrectly encoded';
		default:
			return 'Unknown error';
		}
	}
}

?>
