
        <div class="master">
            <div class="box">
                <div class="header">
                    <h1 class="header__title">    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    Guided Wizard
</h1>
                </div>
                <ul class="step">
                    <li class="step__divider"></li>
                    <li class="step__item ">
                        <i class="step__icon fa fa-server" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item  active ">
                                                    <a href="<?php echo base_url();?>install/environment">
                                <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                            </a>
                                            </li>
                    <li class="step__divider"></li>
                    <li class="step__item ">
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
                                                                <!-- <div class="tabs tabs-full"> -->


        <?php
        $attributes = array('autocomplete'=>'off');
        //form validation
        // echo validation_errors();
        echo form_open($this->uri->uri_string(), $attributes);
        ?>
        <?php if (validation_errors()): ?>
        <div class="alert alert-danger alert-dismissible" id="error_alert">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        	<h4><i class="icon fa fa-ban"></i> Errors!</h4>
        	<?php echo validation_errors(); ?>
        </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('msg')) : ?>
  			<div class="alert alert-danger alert-dismissible" id="error_alert">
  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  				<h4><i class="icon fa fa-info-circle"></i> Errors!</h4>
  				<?php echo $this->session->flashdata('msg'); ?>
  			</div>
  			<?php endif; ?>
                <div class="form-group ">
                    <label for="database_connection">
                        Database Connection
                    </label>
                    <select name="database_connection" id="database_connection">
                        <option value="mysql" selected>mysql</option>
                        <option value="sqlite">sqlite</option>
                        <option value="pgsql">pgsql</option>
                        <option value="sqlsrv">sqlsrv</option>
                    </select>
                </div>

                <div class="form-group ">
                    <label for="database_hostname">
                        Database Host
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="Database Host" />
                </div>

                <div class="form-group ">
                    <label for="database_port">
                        Database Port
                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" placeholder="Database Port" />
                                    </div>

                <div class="form-group ">
                    <label for="database_name">
                        Database Name
                    </label>
                    <input type="text" name="database_name" id="database_name" value="" placeholder="Database Name" />
                                    </div>

                <div class="form-group ">
                    <label for="database_username">
                        Database User Name
                    </label>
                    <input type="text" name="database_username" id="database_username" value="" placeholder="Database User Name" />
                                    </div>

                <div class="form-group ">
                    <label for="database_password">
                        Database Password
                    </label>
                    <input type="password" name="database_password" id="database_password" value="" placeholder="Database Password" />
                                    </div>

                <div class="buttons">
                    <button class="button" type="submit">
                        Install
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
        </form>

                </div>
            </div>
        </div>
