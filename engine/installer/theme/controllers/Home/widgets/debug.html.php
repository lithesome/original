<?php

	use Core\Classes\Render;
	use Controllers\Home\Config;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var string $key
	 * @var string $class
	 * @var string $title
	 * @var string $method
	 * @var integer $status
	 * @var array $options
	 * @var string $position
	 * @var string $template
	 * @var integer $relevance
	 * @var array $arguments
	 */

	if (!Config::core('debug')) {
		return false;
	}

	$content = $this->response->getDebug();

	$files = get_included_files();
	$time = number_format(microtime(true) - TIME, 5);
	$memory = prepare_memory(memory_get_usage() - MEMORY);
	$max_memory = prepare_memory(memory_get_peak_usage() - MEMORY);
	$total_memory = prepare_memory(memory_get_peak_usage());

	/**
	 * @param array|string $query
	 * @return string
	 */
	$get_query = function ($query) {
		if (is_array($query)) {
			$result = '';
			foreach ($query as $index => $value) {
				$result .= "<span class=\"query-segments query-segment-{$index}\">{$value}</span><span class=\"rarr\">&rarr;</span>";
			}
			return rtrim($result, "<span class=\"rarr\">&rarr;</span>");
		}
		return $query;
	};

	$this->appendCSS('controllers/Home/styles/debug');
	$this->appendJS('controllers/Home/scripts/index');
?>
	<div class="debug container p-0">
		<div class="row p-0 m-0">
			<div class="item mx-auto">
				<div class="name">
					<?php __(lang('Home.debug.debug_time')) ?>
				</div>
				<div class="value">
					(<?php __($time) ?>)
				</div>
			</div>
			<div class="item mx-auto">
				<div class="name">
					<?php __(lang('Home.debug.debug_memory')) ?>
				</div>
				<div class="value">
					(<?php __($memory) ?>)
				</div>
			</div>
			<div class="item mx-auto">
				<div class="name">
					<?php __(lang('Home.debug.debug_mem_max')) ?>
				</div>
				<div class="value">
					(<?php __($max_memory) ?>)
				</div>
			</div>
			<div class="item mx-auto">
				<div class="name">
					<?php __(lang('Home.debug.debug_mem_all')) ?>
				</div>
				<div class="value">
					(<?php __($total_memory) ?>)
				</div>
			</div>
			<?php foreach ($content as $key => $item) { ?>
				<?php $key_id = str_replace('.', '_', $key) ?>

				<div class="item mx-auto">
					<a data-toggle="modal" data-target="#<?php __($key_id) ?>-debug-modal"
					   href="javascript:void(0)">
						<div class="name"><?php __(lang($key)) ?></div>
						<div class="value">
							(<?php __(count($item)) ?>)
						</div>
					</a>
				</div>
			<?php } ?>
			<div class="item mx-auto">
				<a data-toggle="modal" data-target="#files-debug-modal" href="javascript:void(0)">
					<div class="name">
						<?php __(lang('Home.debug.debug_files')) ?>
					</div>
					<div class="value">
						(<?php __(count($files)) ?>)
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-xl" id="files-debug-modal" tabindex="-1" role="dialog"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?php __(lang('Home.debug.debug_files')) ?></h5>
					<a type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</a>
				</div>

				<div class="accordion">
					<div class="card">
						<ol>
							<?php foreach ($files as $file) { ?>
								<li>
									<div class="card-header files-block">
										<?php __($file) ?>
									</div>
								</li>
							<?php } ?>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php foreach ($content as $key => $item) { ?>
	<?php $key_id = str_replace('.', '_', $key) ?>
	<div class="modal fade bd-example-modal-xl" id="<?php __($key_id) ?>-debug-modal" tabindex="-1" role="dialog"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?php __(lang($key)) ?></h5>
					<a type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</a>
				</div>

				<div class="accordion" id="accordion-<?php __($key_id) ?>">
					<ol>
						<?php foreach ($item as $index => $value) { ?>
							<li>
								<div class="clipper">
									<a href="javascript:void(0)" onclick="HomeObject.copyQueryToClipBoard(this)">
										<i class="far fa-copy text-danger"></i>
									</a>
								</div>
								<div class="card">
									<div class="card-header" id="heading-<?php __($key_id) ?><?php __($index) ?>"
										 data-toggle="collapse"
										 data-target="#collapse-<?php __($key_id) ?><?php __($index) ?>"
										 aria-expanded="true"
										 aria-controls="collapse-<?php __($key_id) ?><?php __($index) ?>">

										<div class="class-block d-flex">
											<div
												class="class"><?php __(isset($value['trace'][$value['index']]['class']) ? $value['trace'][$value['index']]['class'] : '[class]') ?></div>
											<div class="type"><span class="rarr">&rarr;</span></div>
											<div
												class="function"><?php __(isset($value['trace'][$value['index']]['function']) ? $value['trace'][$value['index']]['function'] : '[function]') ?>
												()
											</div>
										</div>

										<div class="query-block d-flex">
											<div class="mb-0 query">
												<pre><?php __($get_query($value['query'])) ?></pre>
											</div>
										</div>

										<div class="file-block d-flex">
											<div
												class="file"><?php __(isset($value['trace'][$value['index']]['file']) ? $value['trace'][$value['index']]['file'] : '[file]') ?>
												,
											</div>
											<div
												class="line"><?php __(isset($value['trace'][$value['index']]['line']) ? $value['trace'][$value['index']]['line'] : '[line]') ?></div>
										</div>

										<div
											class="time text-<?php __($value['time'] > 0.001 ? 'danger' : 'success') ?>">
											<?php __($value['time']) ?>
										</div>

									</div>
									<div id="collapse-<?php __($key_id) ?><?php __($index) ?>"
										 class="collapse<?php if (!$index) { ?> show<?php } ?>"
										 aria-labelledby="heading-<?php __($key_id) ?><?php __($index) ?>"
										 data-parent="#accordion-<?php __($key_id) ?>">
										<div class="card-body">
											<ol>
												<?php foreach ($value['trace'] as $trace) { ?>
													<li>
														<div class="class-block d-flex">
															<div
																class="class"><?php __(isset($trace['class']) ? $trace['class'] : '[class]') ?></div>
															<div class="type"><span class="rarr">&rarr;</span></div>
															<div
																class="function"><?php __(isset($trace['function']) ? $trace['function'] : '[function]') ?>
																()
															</div>
														</div>
														<div class="file-block d-flex">
															<div
																class="file"><?php __(isset($trace['file']) ? $trace['file'] : '[file]') ?>
																,
															</div>
															<div
																class="line"><?php __(isset($trace['line']) ? $trace['line'] : '[line]') ?></div>
														</div>
														<hr>
													</li>
												<?php } ?>
											</ol>
										</div>
									</div>
								</div>
							</li>
						<?php } ?>
					</ol>
				</div>
			</div>
		</div>
	</div>
<?php } ?>