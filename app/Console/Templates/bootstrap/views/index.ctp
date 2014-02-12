		<div class="<?php echo $pluralVar; ?> index">
			<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>

			<div class="actions btn-toolbar">
				<div class="btn-group">
					<?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'), array('class' => 'btn btn-default')); ?>"; ?>
				</div>
				<div class="btn-group">
					<?php
						$done = array();
						foreach ($associations as $type => $data) {
							foreach ($data as $alias => $details) {
								if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
									echo "\t\t\t\t<?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'), array('class' => 'btn btn-default')); ?>\n";
									echo "\t\t\t\t<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('class' => 'btn btn-default')); ?>\n";
									$done[] = $details['controller'];
								}
							}
						}
					?>
				</div>
			</div>

			<table cellpadding="0" cellspacing="0" class="table table-striped table-hover" style="margin-top:20px;">
			<tr>
			<?php foreach ($fields as $field): ?>
				<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
			<?php endforeach; ?>
				<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
			</tr>
			<?php
			echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
			echo "\t<tr>\n";
				foreach ($fields as $field) {
					$isKey = false;
					if (!empty($associations['belongsTo'])) {
						foreach ($associations['belongsTo'] as $alias => $details) {
							if ($field === $details['foreignKey']) {
								$isKey = true;
								echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
								break;
							}
						}
					}
					if ($isKey !== true) {
						echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
					}
				}

				echo "\t\t<td class=\"actions\">\n";
				echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-file-text-o\"></i> View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-primary btn-xs', 'escape' => false)); ?>\n";
				echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-pencil\"></i> Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-default btn-xs', 'escape' => false)); ?>\n";
				echo "\t\t\t<?php echo \$this->Form->postLink(__('<i class=\"fa fa-trash-o\"></i> Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
				echo "\t\t</td>\n";
			echo "\t</tr>\n";

			echo "<?php endforeach; ?>\n";
			?>
			</table>
			<?php echo "\n\t\t\t<?php \$params = \$this->Paginator->params();
				if (\$params['pageCount'] > 1): ?>
			<p class=\"muted\">
				<?php echo \$this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
			</p>
			<?php endif; ?>\n"; ?>
			<?php echo "\n\t\t\t<?php echo \$this->Paginator->pagination(); ?>\n"; ?>
		</div>