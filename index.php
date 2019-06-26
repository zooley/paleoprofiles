<?php
$path = '/animalia';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Site info -->
		<meta name="keywords" content="paleontology, paeleontology, dinosaurs, dinosauria" />
		<meta name="description" content="Vector-based profiles of paleontological specimens" />

		<title>Paleo Profiles</title>

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="./assets/css/index.css" />

		<!-- Scripts -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script src="./assets/js/jquery-3.3.1.min.js"></script>
		<script src="./assets/js/index.js"></script>
	</head>
	<body>

		<header class="navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-inner">
					<h1><a class="brand" href="#">Paleo Profiles</a></h1>
					<form method="get" action="" class="navbar-form">
						<ul class="nav pull-right">
							<li>
								<span class="size-adjust" data-container="all-specimens">
									<a class="size-small selected" data-size="small" href="#size-small">Small icons</a>
									<a class="size-large" data-size="large" href="#size-large">Large icons</a>
								</span>
							</li>
							<li>
								<select name="type" id="type">
									<option value="all">All</option>
									<optgroup label="Dinosauria">
										<option value="dinosauria">All</option>
										<option value="theropods">Theropods</option>
										<option value="sauropods">Sauropods</option>
									</optgroup>
									<option value="mammalia">Mammalia</option>
									<option value="pterosauria">Pterosauria</option>
									<option value="mosasauridae">Mosasauridae</option>
								</select>
								<input name="search" id="search" class="search-query" placeholder="Search..." />
							</li>
						</ul>
					</form>
				</div>
			</div>
		</header>

		<div class="container">
			<main id="all-specimens" class="small">
				<ul class="specimens">
					<?php
					$specimens = array();

					if (is_dir(__DIR__ . '/animalia'))
					{
						foreach (new DirectoryIterator(__DIR__ . '/animalia') as $fileInfo)
						{
							if ($fileInfo->isDot() || !$fileInfo->isDir())
							{
								continue;
							}

							foreach (new DirectoryIterator($fileInfo->getPathname()) as $file)
							{
								if ($file->isDot() || substr($file->getFilename(), 0, 1) == '.')
								{
									continue;
								}

								$specimens[] = array(
									'file'     => $file->getPathname(),
									'name'     => str_replace(array('-', '.svg'), array(' ', ''), $file->getFilename()),
									'keywords' => array(),
									'type'     => array($fileInfo->getFilename()),
								);
							}
						}
					}

					foreach ($specimens as $specimen)
					{
						$specimen['keywords'][] = $specimen['name'];
						?>
						<li data-keywords="<?php echo implode(', ', $specimen['keywords']); ?>" data-type="<?php echo implode(', ', $specimen['type']); ?>">
							<div class="specimen-content">
								<div class="specimen-figure">
									<figure>
										<?php echo file_get_contents($specimen['file']); ?>
									</figure>
								</div>
								<div class="specimen-details">
									<div class="name"><?php echo $specimen['name']; ?></div>
								</div>
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</main>

			<footer>
				<p>
					Copyright &copy; <?php echo gmdate("Y"); ?> Paleo Profiles
				</p>
			</footer>
		</div>

	</body>
</html>