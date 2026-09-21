<?php
$is_locked      = ! empty( $is_locked );
$roles_disabled = isset( $roles_disabled ) ? (array) $roles_disabled : array();
?>
<div class="sui-box" data-id="<?php echo esc_attr( $id ); ?>">
	<div class="sui-row">
		<div class="<?php echo $is_locked ? 'sui-col-lg-12' : 'sui-col-lg-10'; ?>">
			<input type="text" class="sui-form-control" value="<?php echo esc_attr( $code ); ?>" placeholder="<?php esc_attr_e( 'Signup code', 'ub' ); ?>" name="simple_options[user][<?php echo esc_attr( $id ); ?>][code]" <?php disabled( $is_locked ); ?> />
		</div>
		<?php if ( ! $is_locked ) { ?>
		<div class="sui-col-lg-2">
			<div class="sui-button-icon sui-button-red">
				<i class="sui-icon-trash" aria-hidden="true"></i>
				<span class="sui-screen-reader-text"><?php esc_html_e( 'Remove item', 'ub' ); ?></span>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="sui-row">
		<div class="sui-col">
			<select name="simple_options[user][<?php echo esc_attr( $id ); ?>][role]" <?php disabled( $is_locked ); ?>>
				<?php
				foreach ( $roles as $key => $value ) {
					$is_disabled = $is_locked || ( in_array( $key, $roles_disabled, true ) && $key !== $role );
					?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $role, $key ); ?> <?php disabled( $is_disabled ); ?>><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="sui-col">
			<label class="sui-checkbox">
				<input type="checkbox" name="simple_options[user][<?php echo esc_attr( $id ); ?>][case]" <?php checked( $case, 'sensitive' ); ?> <?php disabled( $is_locked ); ?> />
				<span aria-hidden="true"></span>
				<span><?php esc_html_e( 'Case Sensitive', 'ub' ); ?></span>
			</label>
		</div>
	</div>
</div>
