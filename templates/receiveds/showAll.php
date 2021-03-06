<?php
	//Template dashboard
	$incs = new internalIncs();
	$incs->head('Receiveds - Show All');
?>
<div id="wrapper">
<?php
	$incs->nav('receiveds');
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Dashboard <small>SMS reçus</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-dashboard"></i> <a href="<?php echo $this->generateUrl('dashboard'); ?>">Dashboard</a>
						</li>
						<li class="active">
							<i class="fa fa-download "></i> SMS reçus
						</li>
					</ol>
				</div>
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-download  fa-fw"></i> Liste des SMS reçus</h3>
						</div>
						<div class="panel-body">
							<div class="table-receiveds">
								<table class="table table-bordered table-hover table-striped" id="table-receiveds">
									<thead>
										<tr>
											<th>#</th>
											<th>Numéro</th>
											<th>Message</th>
											<th>Date</th>
											<th>Commande</th>
											<?php if ($_SESSION['admin']) { ?><th>Sélectionner</th><?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php
										foreach ($receiveds as $received)
										{
											?>
											<tr>
												<td><?php secho($received['id']); ?></td>
												<td><?php secho($received['send_by']); ?></td>
												<td><?php secho($received['content']); ?></td>
												<td><?php secho($received['at']); ?></td>
												<td><?php echo $received['is_command'] ? 'Oui' : 'Non'; ?></td>
												<?php if ($_SESSION['admin']) { ?><td><input type="checkbox" value="<?php secho($received['id']); ?>"></td><?php } ?>
											</tr>
											<?php
										}
									?>
									</tbody>
								</table>
							</div>
							<nav>
								<?php if ($_SESSION['admin']) { ?>
									<div class="text-right col-xs-12 no-padding">
										<strong>Action groupée :</strong> 
										<div class="btn-group action-dropdown" target="#table-receiveds">
											<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action pour la sélection <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li><a href="<?php echo $this->generateUrl('receiveds', 'delete', [$_SESSION['csrf']]); ?>"><span class="fa fa-trash-o"></span> Supprimer</a></li>
											</ul>
										</div>
									</div>
								<?php } ?>
								<ul class="pager">
									<?php
										if ($page)
										{
										?>
											<li><a href="<?php echo $this->generateUrl('receiveds', 'showAll', array('page' => $page - 1)); ?>"><span aria-hidden="true">&larr;</span> Précèdents</a></li>
										<?php
										}

										$numero_page = 'Page : ' . ($page + 1);
										secho($numero_page);

										if ($limit == $nbResults)
										{
										?>
											<li><a href="<?php echo $this->generateUrl('receiveds', 'showAll', array('page' => $page + 1)); ?>">Suivants <span aria-hidden="true">&rarr;</span></a></li>
										<?php
										}
									?>
								</ul>
							</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function ()
	{
		jQuery('.action-dropdown a').on('click', function (e)
		{
			e.preventDefault();
			var target = jQuery(this).parents('.action-dropdown').attr('target');
			var url = jQuery(this).attr('href');
			jQuery(target).find('input:checked').each(function ()
			{
				url += '/' + jQuery(this).val();
			});
			window.location = url;
		});
	});
</script>
<?php
	$incs->footer();
