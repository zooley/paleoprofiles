<?php
$path = '/animalia';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Site info -->
		<meta name="keywords" content="paleontology, paeleontology, dinosaurs, dinosauria" />
		<meta name="description" content="Vector-based profiles of paleontological specimens" />

		<title>Paleo Profiles</title>

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="./assets/css/index.css" />
	</head>
	<body>
		<div id="outer-wrap">

			<header id="masthead" role="banner">
				<h1>
					<a href="./" title="Paleo Profiles">
						<span>Paleo Profiles</span>
					</a>
				</h1>

				<nav class="header-row" id="nav" role="main">
					<div class="header-nav">
						<ul class="menu">
							<li>
								<a href="#home" class="links-to-floor" data-id="1">Home</a>
							</li>
							<li>
								<a href="#dinosauria" class="links-to-floor" data-id="2">Dinosauria</a>
							</li>
							<li>
								<a href="#pterosauria" class="links-to-floor" data-id="4">Pterosauria</a>
							</li>
							<li>
								<a href="#mammalia" class="links-to-floor" data-id="3">Mammalia</a>
							</li>
							<li>
								<a href="#mosasauridae">Mosasauridae</a>
							</li>
						</ul>
					</div>
				</nav><!-- / #nav -->
			</header><!-- / #masthead -->

			<div id="wrap">
				<main id="content" role="main">
					<div class="inner">

						<?php
						foreach (new DirectoryIterator(__DIR__ . '/animalia') as $fileInfo)
						{
							if ($fileInfo->isDot() || !$fileInfo->isDir())
							{
								continue;
							}
							?>
							<div class="specimens" id="dinosauria">
								<h3><?php echo $fileInfo->getFilename(); ?></h3>

								<?php
								foreach (new DirectoryIterator($fileInfo->getPathname()) as $file)
								{
									if ($file->isDot() || substr($file->getFilename(), 0, 1) == '.')
									{
										continue;
									}
									?>
									<div class="specimen">
										<h4><?php echo str_replace(array('-', '.svg'), array(' ', ''), $file->getFilename()); ?></h4>
										<figure>
											<?php echo file_get_contents($file->getPathname()); ?>
										</figure>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>

					</div><!-- / .inner -->
				</main><!-- / #content -->

				<footer id="footer">
					Copyright <?php echo gmdate('Y'); ?> Paleo Profiles
				</footer><!-- / #footer -->
			</div><!-- / #wrap -->
		</div>

	</body>
</html>