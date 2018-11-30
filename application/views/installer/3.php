<?php
$this->load->config('installer', TRUE);
$results = array();
$write = $this->config->item('is_writable', 'installer');
foreach ($write as $value) {
  $results['write'][$value] = true;
  if(!is_writable($value))
  {
      $results['write'][$value] = false;
      $results['errors'] = true;
  }
}
?>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
    Permissions
</h1>
            </div>
            <ul class="step">
                <li class="step__divider"></li>
                <li class="step__item ">
                    <i class="step__icon fa fa-server" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li class="step__item   ">
                    <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li class="step__item active">
                    <a href="<?php echo base_url();?>install/permissions">
                        <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="step__divider"></li>
                <li class="step__item ">
                    <a href="<?php echo base_url();?>install/requirements">
                        <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="step__divider"></li>
                <li class="step__item ">
                    <a href="<?php echo base_url();?>install">
                        <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="step__divider"></li>
            </ul>
            <div class="main">

                <ul class="list">
                    <?php
      foreach ($results['write'] as $is_writable => $valid) {
      ?>
                        <li class="list__item list__item--permissions <?= $valid ? 'success' : 'error' ;?>">
                            <?= $is_writable ;?>
                                <i class="fa fa-fw fa-<?=$valid ? 'check-circle-o' : 'exclamation-circle' ;?> row-icon" aria-hidden="true"></i>
                        </li>
                        <?php
      }
      ?>

                </ul>
                <?php
              if (!isset($results['errors'])) {
            ?>
                    <div class="buttons">
                        <a href="<?php echo base_url();?>install/environment" class="button">
                Configure Environment
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
