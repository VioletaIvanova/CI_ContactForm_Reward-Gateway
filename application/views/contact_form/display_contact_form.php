
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <?php echo form_open('contact/contactForm', array('class'=>'form-horizontal'));?>
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <?php echo form_error('name'); ?>
                                <?php echo form_input(array('name' => 'name','class' => 'form-control','value' => set_value('name', ''),'id'=>'name','placeholder'=>'Name'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <?php echo form_error('email'); ?>
                                <?php echo form_input(array('name' => 'email','class' => 'form-control','value' => set_value('email', ''),'id'=>'email','placeholder'=>'Email Address'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <?php echo form_error('phone'); ?>
                                <?php echo form_input(array('name' => 'phone','class' => 'form-control','value' => set_value('phone', ''),'id'=>'phone','placeholder'=>'Phone Number'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <?php echo form_error('message'); ?>
                                <?php echo form_textarea(array('name' => 'message','class' => 'form-control','value' => set_value('message', ''),'id'=>'message','placeholder'=>'Enter your message here.'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-8">
                            <div>
                                <?php echo isset($error)? '<div class="alert alert-danger">'.$error.'</div>' : ''; ?>
                                <?php echo $this->recaptcha->render(); ?>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
