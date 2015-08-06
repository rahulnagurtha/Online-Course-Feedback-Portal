<?php


require_once(realpath(dirname(dirname(__FILE__))).'/config.php');

/**
 * Top navigation bar
 * pass __FILE__ into $present
 */

class Nav {
	public function __construct($config, $items, $present) {
		//nav bar html start
		?>
		<div class="row">
<div class="col-md-8 col-md-offset-2">
  <nav class="navbar navbar-default" role="navigation">
  	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $config['name']['institution']; ?></a>
    </div>

  <div class="container-fluid">
  <div class="collapse navbar-collapse" id="nav-toggle">
  	<ul class="nav navbar-nav navbar-right">
  	<?php foreach($items as $item) {
  			$item_url = $config['url']['base_url'].$config['url'][$item]; ?>
  	<li <?php if(realpath(BASE_PATH.$config['url'][$item]) == realpath($present)) { ?> class="active" <?php  } ?> ><a href="<?php echo $item_url; ?>"><?php echo $config['name'][$item]; ?></a></li>
  	<?php } ?>
  	</ul>

  </div>
  </div>


</nav>
</div>
</div>   
		<?php
		//navbar html end


	}
}



?>
