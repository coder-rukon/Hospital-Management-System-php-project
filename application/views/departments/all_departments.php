
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
    <h2>List Of All Departments</h2>
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
          <th  style="width:50px">#</th>
          <th>Name</th>
          <th>Descriptions</th>
          <th style="width:25%">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(isset($departments)){
            foreach ($departments as $key => $value) {
              ?>
              <tr>
                <th scope="row"><?php echo $key; ?></th>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->description; ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>department/about/<?php echo $value->id; ?>" class="btn btn-xs btn-success"><i class="fa fa-eye fa-2" aria-hidden="true"></i> Details</a>
                  <a href="<?php echo base_url(); ?>department/update/<?php echo $value->id; ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o fa-2" aria-hidden="true"></i> Edit</a>
                  <a href="<?php echo base_url(); ?>department/delete/<?php echo $value->id; ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> Delete</a>
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

