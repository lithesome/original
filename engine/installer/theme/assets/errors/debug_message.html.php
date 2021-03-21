<?php
	/**
	 * @var \Core\Classes\Errors $this
	 */

?>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php __(get_http_theme('styles/errors.css')) ?>"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title><?php __(mb_strtoupper($this->error_type)) ?></title>
</head>
<body>
<div class="container mb-4 pb-4">
	<div class="row justify-content-center">
		<div class="col-12 header">
			<div class="error-type bg-danger text-white text-center"><?php __($this->error_type) ?></div>
			<div class="error-message mt-2 mb-2">
				<div class="bg-warning text-white pl-4 pt-4 pb-4"><?php __($this->error_message) ?></div>
				<?php if ($this->query) { ?>
					<pre
						class="bg-danger text-white pl-4 mt-2 mb-2 pt-2 pb-2"><code><?php __($this->query) ?></code></pre>
				<?php } ?>
			</div>
			<div class="error-file-and-line bg-secondary text-white pl-4">
				<span class="error-file text-white"><?php __($this->error_file) ?></span>,
				<span class="error-line bg-warning text-white"><?php __($this->error_line) ?></span>
			</div>
			<pre class="query"><?php __($this->errorGetFileContent($this->error_file, $this->error_line)) ?></pre>
		</div>
		<div class="delimiter col-12 text-center">
			<?php __(lang('Home.error.backtrace_chart')) ?>
		</div>
		<div class="body col-12">
			<div id="accordion">
				<?php $this->backtrace = array_reverse($this->backtrace) ?>
				<?php foreach ($this->backtrace as $index => $trace) { ?>
					<div class="card"<?php if (!isset($trace['file'])) { ?> style="opacity: 0.2"<?php } ?>>

						<a href="javascript:void(0)" class="text-left" data-toggle="collapse"
						   data-target="#collapse<?php __($index) ?>" aria-expanded="true"
						   aria-controls="collapse<?php __($index) ?>">
							<div class="class-type-method" id="heading<?php __($index) ?>">
								<div class="col-12 bg-success text-white p-2">
												<span class="class">
													<?php __(isset($trace['class']) ? $trace['class'] : 'NO CLASS') ?>
												</span>
									<span class="type">
													<?php __(isset($trace['type']) ? $trace['type'] : 'NO TYPE') ?>
												</span>
									<span class="method">
													<?php __(isset($trace['function']) ? $trace['function'] . '( )' : 'NO FUNCTION') ?>
												</span>
								</div>
							</div>
						</a>
						<?php if (isset($trace['file'])) { ?>
							<div id="collapse<?php __($index) ?>" class="collapse<?php //__(!$index ? ' show' : '') ?>"
								 aria-labelledby="heading<?php __($index) ?>" data-parent="#accordion">
								<div class="card-body">
											<pre><?php __($this->errorGetFileContent(
													!isset($trace['file']) ?: $trace['file'],
													!isset($trace['line']) ?: $trace['line']
												)) ?></pre>
									<div class="error-file-and-line text-primary">
												<span class="error-file">
													<?php __(isset($trace['file']) ? $trace['file'] : 'NO FILE') ?>
												</span>,
										<span class="error-line bg-danger text-white pr-4 pl-4">
													<?php __(isset($trace['line']) ? $trace['line'] : 'NO LINE') ?>
												</span>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
