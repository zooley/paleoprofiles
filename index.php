<?php

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
		<script src="./assets/js/index.js"></script>
	</head>
	<body>

		<header class="navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-inner">
					<h1><a class="brand" href="#">Paleo Profiles</a></h1>
					<form method="get" action="" class="navbar-form">
						<ul class="nav">
							<li>
								<span class="size-adjust" data-container="all-specimens">
									<a class="size-small selected" data-size="small" href="#size-small">Small icons</a>
									<a class="size-large" data-size="large" href="#size-large">Large icons</a>
								</span>
							</li>
							<li>
								<div class="form-control">
									<label for="type">Type</label>
									<select name="type" id="type">
										<option value="all">All</option>
										<optgroup label="Dinosauria">
											<option value="dinosauria">All</option>
											<option value="theropoda">Theropoda</option>
											<option value="sauropoda">Sauropoda</option>
											<option value="ornithischia">Ornithischia</option>
										</optgroup>
										<option value="mammalia">Mammalia</option>
										<option value="pterosauria">Pterosauria</option>
										<option value="mosasauridae">Mosasauridae</option>
									</select>
								</div>
							</li>
							<li>
								<div class="form-control">
									<label for="search">Search</label>
									<input type="search" name="search" id="search" class="search-query" placeholder="Search..." />
								</div>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</header>

		<div class="container">
			<main id="all-specimens" class="small show-teeth show-outline show-fenestra">
				<div class="toggles">
					Display:

					<div class="form-control">
						<label for="toggle-fenestra">
							<input type="checkbox" name="fenestra" id="toggle-fenestra" class="toggle" value="1" checked="checked" />
							Fenestra
						</label>
					</div>

					<div class="form-control">
						<label for="toggle-teeth">
							<input type="checkbox" name="teeth" id="toggle-teeth" class="toggle" value="1" checked="checked" />
							Teeth
						</label>
					</div>

					<div class="form-control">
						<label for="toggle-outline">
							<input type="checkbox" name="outline" id="toggle-outline" class="toggle" value="1" checked="checked" />
							Outline
						</label>
					</div>
				</div>

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

					function getPhylogeny($root)
					{
						$output = array();

						if ($root->name)
						{
							$output[] = (string) $root->name;
						}

						if ($root->children())
						{
							foreach ($root->children() as $child)
							{
								if ($child->children())
								{
									$output = array_merge($output, getPhylogeny($child));
								}
							}
						}

						return $output;
					}

					foreach ($specimens as $specimen)
					{
						$xmlstr = file_get_contents($specimen['file']);
						$xml = new SimpleXMLElement($xmlstr);
						if ($xml->metadata)
						{
							$specimen['keywords'] = getPhylogeny($xml->metadata->phyloxml->phylogeny);
							$specimen['type'] = $specimen['keywords'];
						}

						$specimen['keywords'][] = $specimen['name'];
						?>
						<li data-keywords="<?php echo strtolower(implode(', ', $specimen['keywords'])); ?>" data-type="<?php echo strtolower(implode(', ', $specimen['type'])); ?>">
							<div class="specimen-content">
								<div class="specimen-figure">
									<figure>
										<?php echo $xmlstr; ?>
									</figure>
								</div>
								<div class="specimen-details">
									<div class="name"><?php echo $xml->title;//$specimen['name']; ?></div>
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