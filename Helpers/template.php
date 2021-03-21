<?php

	use Core\Classes\Render;

	function renderDate($timestamp)
	{
		return '<span class="date-timestamp" data-time="' . $timestamp . '">' . date('j M Y, H:i', $timestamp) . '</span>';
	}

	function isHtml()
	{
		return equal(getRenderMethod(), 'html');
	}

	function isJson()
	{
		return equal(getRenderMethod(), 'json');
	}

	function isFrame()
	{
		return equal(getRenderMethod(), 'frame');
	}

	function isXml()
	{
		return equal(getRenderMethod(), 'xml');
	}

	function isPhp()
	{
		return equal(getRenderMethod(), 'php');
	}

	function getRenderMethod()
	{
		return Render::getInstance()->getRenderType();
	}

	function crop($string, $length = 200, $after = '...')
	{
		$string = strip_tags($string);
		return trim(mb_substr($string, 0, $length)) . (mb_strlen($string) >= $length ? $after : null);
	}

	function e($code = 404)
	{
		$render = Render::getInstance();
		__($render->render(get_root_theme('assets/errors/' . $code . '.html.php'), array()));
		return false;
	}

	function paginate($total, $limit, $offset, $link)
	{
		if ($total <= $limit) {
			return null;
		}
		$content = Render::getInstance()->render(get_root_theme('widgets/pagination.html.php'), array(
			'total' => $total,
			'limit' => $limit,
			'link' => $link,
			'offset' => $offset,
		));
		return $content;
	}

	function renderLoadMoreButton($total, $limit, $offset, $link, $selector)
	{
		if ($total <= $limit) {
			return null;
		}
		return '<div class="load-more row text-center justify-content-center">' .
			'<a href="' . $link . '" onclick="indexObject.loadMore(this, \'' . $selector . '\')" ' .
			'data-offset="' . $offset . '" ' .
			'data-limit="' . $limit . '" ' .
			'data-total="' . $total . '">
					<div class="load-more-button">
						' . lang('Home.button.load_more_value', array(
				'%offset%' => $offset + $limit,
				'%total%' => $total,
				'%limit%' => $limit,
			)) . '
					</div>
				</a>
			</div>';
	}