<script type="text/html" id="tmpl-<?php echo esc_attr( $name ); ?>-user">
<?php
$args = array(
	'id'             => '{{data.id}}',
	'code'           => '',
	'role'           => '-',
	'roles'          => $roles,
	'roles_disabled' => isset( $roles_disabled ) ? (array) $roles_disabled : array(),
	'case'           => '',
	'is_locked'      => false,
);
$this->render( $template, $args );
?>
</script>
