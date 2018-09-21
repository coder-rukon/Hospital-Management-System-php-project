
<div class="page-title">
  <div class="title_left">
  <h3><?php echo $title; ?></h3>
  </div>
  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <form action="" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="s" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <table class="table table-striped">
      <thead>
        <tr>
          <th  style="width:50px">Photo</th>
          <th>About</th>
          <th style="width:25%">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(isset($all_user) && !empty($all_user)){
            foreach ($all_user as $key => $value) {
              ?>
              <tr>
                <td><img class="thumbnail" style="width:80px; height:auto;margin:0;" src="<?php echo $value->picture; ?>" alt=""></td>
                <td style="vertical-align: middle;">
                  <table>
                    <tr>
                      <td width="150"><strong>Name: </strong></td>
                      <td colspan="3"><?php echo $value->full_name; ?></td>
                    </tr>
                    <tr>
                      <td width="100"><strong>Email: </strong></td>
                      <td> <?php echo $value->email; ?></td>
                      <td width="100"><strong style="margin-left:10px;">role: </strong></td>
                      <td> <?php echo $value->role; ?></td>
                    </tr>
                  </table>
                </td>
                <td  style="vertical-align: middle;">
                  <a href="<?php echo base_url(); ?>user/update/<?php echo $value->id; ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o fa-2" aria-hidden="true"></i> Edit</a>
                  <a href="<?php echo base_url(); ?>user/delete/<?php echo $value->id; ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> Delete</a>
                </td>
              </tr>
              <?php
            }
          }
        ?>
      </tbody>
    </table>

  </div>
</div>

