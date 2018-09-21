
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php
              echo form_open();
            ?>
              <h1>Login Form</h1>
              <?php
                if(isset($message)){
                 echo '<p class="validations_error text-danger">';
                  echo $message;
                  echo '</p>';
                }
                if(validation_errors())
                {
                  echo '<div class="validations_error  text-red">';
                  echo validation_errors();
                  echo '</div>';
                }
              ?>
              <div>
                <?php
                  echo form_input(
                      array(
                          'name' => 'u_name',
                          'value' => set_value('u_name'),
                          'class' => 'form-control',
                          'placeholder' => 'Username',
                        )
                    );
                ?>
              </div>
              <div>
                <?php
                  echo form_password(
                      array(
                          'name' => 'u_pass',
                          'value' => set_value('u_pass'),
                          'class' => 'form-control',
                          'placeholder' => 'Password',
                        )
                    );
                ?>
              </div>
              <div>
                <button class="btn btn-default submit">Log in</button>
<!--                 <a class="reset_pass" href="#">Lost your password?</a>
               -->              </div>

              <div class="clearfix"></div>

            <?php
              echo form_close();
            ?>
          </section>
        </div>
      </div>