<?php if(!isset($exibir_todos_downloads)): ?>
		<h2>Exibindo todos os downloads</h2>
<?php else: ?>
			<label>Subcategorias
				<select id="subcategorias" name="subcategoria">
					<?php if($query_subcategorias->num_rows() == 0):?>
					<option disabled="disabled" selected="selected">Nenhuma subcategoria</option>
					<?php else: ?>
					<option disabled="disabled" selected="selected">Selecione...</option>
					<?php
						foreach($query_subcategorias->result() as $categoria): ?>
							<option value="<?php echo $categoria->id_downloads_categorias; ?>"><?php echo $categoria->nome_categoria; ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</label>
<?php endif; ?>