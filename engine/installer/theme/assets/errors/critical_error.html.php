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
	<title><?php __(mb_strtoupper(lang('Home.error.c_error_body'))) ?></title>
</head>
<body>
<div class="container critical-error">
	<div class="row justify-content-center">
		<div class="col-12 bg-danger text-white">
			<div class="min-vh-100 mb-4 pb-4">
				<div class="error-head header text-center"><?php __(lang('Home.error.c_error_header')) ?></div>
				<div class="compcontainer">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90.5 74.769">
						<path fill="#C7CCDB" d="M58.073 74.769H32.426l6.412-19.236h12.824z"></path>
						<path fill="#373F45"
							  d="M90.5 52.063c0 1.917-2.025 3.471-4.525 3.471H4.525C2.025 55.534 0 53.98 0 52.063V3.471C0 1.554 2.026 0 4.525 0h81.449c2.5 0 4.525 1.554 4.525 3.471v48.592z"></path>
						<path fill="#F1F2F2"
							  d="M84.586 46.889c0 1.509-1.762 2.731-3.936 2.731H9.846c-2.172 0-3.933-1.223-3.933-2.731V8.646c0-1.508 1.761-2.732 3.933-2.732H80.65c2.174 0 3.936 1.225 3.936 2.732v38.243z"></path>
						<path fill="#A2A7A5"
							  d="M16.426 5.913L8.051 23h13l-6.875 12.384L26.75 46.259l-8.375-11.375L26.75 20H14.625l6.801-14.087zM68.551 49.62l-8.375-17.087h13l-6.875-12.384L78.875 9.274 70.5 20.649l8.375 14.884H66.75l6.801 14.087z"></path>
					</svg>
				</div>
				<div class="error-body">
					<div class="error-head body text-center mt-4"><?php __(lang('Home.error.c_error_body')) ?></div>
					<div class="text-white bg-white">
						<hr>
					</div>
					<div
						class="error-head body body-logged text- mt-4"><?php __(lang('Home.error.c_error_logged')) ?></div>
					<div
						class="error-head body body-logged text- mt-4"><?php __(lang('Home.error.c_error_soon')) ?></div>
					<div class="text-white bg-white">
						<hr>
					</div>
					<div
						class="error-head body body-update text- mt-4"><?php __(lang('Home.error.c_error_update')) ?></div>
					<div class="btn-group col-12 mt-4">
						<a class="btn btn-success" href="/"><?php __(lang('Home.error.home_link')) ?></a>
						<?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
							<a class="btn btn-primary"
							   href="<?php __($_SERVER['HTTP_REFERER']) ?>"><?php __(lang('Home.error.back_link')) ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>