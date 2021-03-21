<?php

	namespace Core\Traits\Render;

	use Core\Classes\Request;
	use Core\Classes\Response\Response;

	trait RenderTypes
	{
		/** @var Request */
		public $request;
		/** @var Response */
		public $response;

		protected function getRenderTypeHtmlContent()
		{
			$this->response->setHeader('Content-Type', 'text/html');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			if (!$this->checkError($this->response->getCode())) {
				$this->renderController();
			}
			return $this->renderMainTemplateFile();
		}

		protected function getRenderTypeJSONPContent()
		{
			return $this->getRenderTypeJavaScriptContent();
		}

		protected function getRenderTypeJavaScriptContent()
		{
			$this->response->setHeader('Content-Type', 'application/json');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			__($this->request->query('JSONP_callback') . '(');
			__(json_encode($this->prepareDataToAnotherMethods(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			__(');');
			return $this;
		}

		protected function getRenderTypeJsonContent()
		{
			$this->response->setHeader('Content-Type', 'application/json');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			__(json_encode($this->prepareDataToAnotherMethods(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			return $this;
		}

		protected function getRenderTypeXmlContent()
		{
			$this->response->setHeader('Content-Type', 'application/xml');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			$result = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
			$result .= '<root>' . PHP_EOL;
			$result .= xml_encode($this->prepareDataToAnotherMethods());
			$result .= '</root>';
			__($result);
			return $this;
		}

		protected function getRenderTypePhpContent()
		{
			$this->response->setHeader('Content-Type', 'text/plain');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			$result = php_encode($this->prepareDataToAnotherMethods());
			__("{$result} ?>");
			return $this;
		}

		protected function getRenderTypeFrameContent()
		{
			$this->response->setHeader('Content-Type', 'text/html');
			$this->sendHeaders($this->response->getHeader(), $this->response->getStatus(), $this->response->getCode());
			if (!$this->checkError($this->response->getCode())) {
				$this->renderController();
			}
			$this->renderTitle();
			$this->renderMeta();
			$this->renderJsFiles();
			$this->renderCssFiles();
			__($this->getContent());
			return $this;
		}

		protected function prepareDataToAnotherMethods()
		{
			return array(
				'code' => $this->response->getCode(),
				'status' => $this->response->getStatus(),
				'location' => $this->response->getLocation(),
				'controller' => $this->response->getController(),
				'action' => $this->response->getAction(),
				'content' => $this->response->getContent(),
				'headers' => $this->response->getHeader(),
				'title' => $this->response->getTitle(),
				'meta' => $this->response->getMeta(),
				'breadcrumbs' => $this->response->getBreadCrumbs(),
				'debug' => $this->response->getDebug(),
//				'errors'		=> $this->response->getErrors(),
			);
		}
	}
