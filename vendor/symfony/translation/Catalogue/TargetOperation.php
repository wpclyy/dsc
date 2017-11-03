<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Catalogue;

class TargetOperation extends AbstractOperation
{
	protected function processDomain($domain)
	{
		$this->messages[$domain] = array(
	'all'      => array(),
	'new'      => array(),
	'obsolete' => array()
	);

		foreach ($this->source->all($domain) as $id => $message) {
			if ($this->target->has($id, $domain)) {
				$this->messages[$domain]['all'][$id] = $message;
				$this->result->add(array($id => $message), $domain);

				if (null !== ($keyMetadata = $this->source->getMetadata($id, $domain))) {
					$this->result->setMetadata($id, $keyMetadata, $domain);
				}
			}
			else {
				$this->messages[$domain]['obsolete'][$id] = $message;
			}
		}

		foreach ($this->target->all($domain) as $id => $message) {
			if (!$this->source->has($id, $domain)) {
				$this->messages[$domain]['all'][$id] = $message;
				$this->messages[$domain]['new'][$id] = $message;
				$this->result->add(array($id => $message), $domain);

				if (null !== ($keyMetadata = $this->target->getMetadata($id, $domain))) {
					$this->result->setMetadata($id, $keyMetadata, $domain);
				}
			}
		}
	}
}

?>
