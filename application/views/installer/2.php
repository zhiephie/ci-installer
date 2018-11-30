<?php
$this->load->config('installer', TRUE);
$supported = false;
$currentVersionFull = PHP_VERSION;
preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
$currentVersion = $filtered[0];
$minVersionPhp = $this->config->item('minVersionPhp', 'installer');
$extPhp = $this->config->item('phpExt', 'installer');
if (version_compare($currentVersion, $minVersionPhp) >= 0)
{
  $supported = true;
}
$results = array();
foreach ($extPhp as $value)
{
  $results['php'][$value] = true;
  if(!extension_loaded($value))
  {
      $results['php'][$value] = false;
      $results['errors'] = true;
  }
}
?>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
                    Server Requirements
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
                <li class="step__item ">
                    <i class="step__icon fa fa-key" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li class="step__item active">
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
                    <li class="list__item list__title <?php echo isset($supported) ? 'success' : 'error' ;?>">
                        <strong>Php</strong>
                        <strong>
                        <small>
                            (version <?php echo $minVersionPhp; ?> required)
                        </small>
                    </strong>
                        <span class="float-right">
                        <strong>
                            <?php echo $minVersionPhp; ?>
                        </strong>
                        <i class="fa fa-fw fa-<?=$supported ? 'check-circle-o' : 'exclamation-circle' ;?> row-icon" aria-hidden="true"></i>
                    </span>
                    </li>

                    <?php
                            foreach ($results['php'] as $extention => $enabled) {
                            ?>
                        <li class="list__item <?= $enabled ? 'success' : 'error' ;?>">
                            <?= $extention ;?>
                                <i class="fa fa-fw fa-<?=$enabled ? 'check-circle-o' : 'exclamation-circle' ;?> row-icon" aria-hidden="true"></i>
                        </li>
                        <?php
                            }
                            ?>

                </ul>
                <?php
              if (!isset($results['errors']) && $supported) {
            ?>
                    <div class="buttons">
                        <a class="button" href="<?php echo base_url();?>install/permissions">
                  Check Permissions
                  <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
              </a>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
