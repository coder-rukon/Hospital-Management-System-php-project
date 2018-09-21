
<div class="page-title">
  <div class="title_left">
  <h3><?php echo $title; ?></h3>
  </div>

  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <?php echo form_open(base_url()."/invoice",array("method" => "GET")); ?>
      <div class="input-group">
        <input type="text" name="s" class="form-control" placeholder="Invoice Id">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">Search</button>
        </span>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <h2>List Of All Invoice</h2>
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
          <th>Invoice Id</th>
          <th>Title</th>
          <th>Date</th>
          <th>Total</th>
          <th style="width:25%">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(isset($all_invoice)){
            foreach ($all_invoice as $key => $value) {
              ?>
              <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->title; ?></td>
                <td><?php echo $value->date; ?></td>
                <td><?php echo $value->total; ?></td>
                <td>
                  <a target="blank" href="<?php echo base_url(); ?>invoice/print/<?php echo $value->id; ?>" class="btn btn-xs btn-success"><i class="fa fa-eye fa-2" aria-hidden="true"></i> Print</a>
                  <a href="<?php echo base_url(); ?>invoice/delete/<?php echo $value->id; ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> Delete</a>
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

