<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $patient[0]->name; ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <table class="table">
          <?php
            $fields = array(
                'name' => 'Patient Name:',
                'phone' => 'Phone',
                'blood_group' => 'Blood Group',
                'department' => 'Department',
                'birth_date' => 'Date Of Birth',
                'age' => 'Age',
                'sex' => 'Gender',
                'email' => 'Email',
                'county' => 'Country',
                'city' => 'City',
                'address' => 'Address',
                'about' => 'About'
              );
            foreach ($fields as $key => $value) {
              ?>
              <tr>
                <td><strong><?php echo $value; ?></strong></td>
                <td><?php echo $patient[0]->{$key}; ?></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
      <div class="col-xs-12 col-sm-6">
        <table class="table">
          <?php
            $fields = array(
                'guardian_name' => 'Gurdian Name',
                'guardian_phone' => 'Gurdian Phone',
                'guardian_details' => 'Gurdian Details',
                'bad_no' => 'Patient Bad No.',
                'referred_by' => 'Referred By',
                'reg_date' => 'Admitted Date',
                'descriptions' => 'Descriptions',
              );
            foreach ($fields as $key => $value) {
              ?>
              <tr>
                <td><strong><?php echo $value; ?></strong></td>
                <td><?php echo $patient[0]->{$key}; ?></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

