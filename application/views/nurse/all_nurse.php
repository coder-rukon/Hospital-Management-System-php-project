
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
    <h2>List Of All Nurse</h2>
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
          if(isset($all_nurse) && !empty($all_nurse)){
            foreach ($all_nurse as $key => $value) {
              ?>
              <tr>
                <td><img class="thumbnail" style="width:80px; height:auto;margin:0;" src="<?php echo $value->picture; ?>" alt=""></td>
                <td style="vertical-align: middle;">
                  <table>
                    <tr>
                      <td width="150"><strong>Name: </strong></td>
                      <td><?php echo $value->name; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Contact: </strong></td>
                      <td><?php echo $value->phone; ?></td>
                    </tr>
                  </table>
                </td>
                <td  style="vertical-align: middle;">
                  <a href="<?php echo base_url(); ?>nurse/about/<?php echo $value->id; ?>" class="btn btn-xs btn-success"><i class="fa fa-eye fa-2" aria-hidden="true"></i> Details</a>
                  <a href="<?php echo base_url(); ?>nurse/update/<?php echo $value->id; ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o fa-2" aria-hidden="true"></i> Edit</a>
                  <a href="<?php echo base_url(); ?>nurse/delete/<?php echo $value->id; ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> Delete</a>
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

