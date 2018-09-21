<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/print.css" rel="stylesheet">
  </head>
  <body>
    <?php
      if(!isset($invoice[0]))
        return;
    ?>
    <div class="invoice_section">
      <div class="invoice_container">
        <div class="invoice_top">
          <img src="<?php echo base_url();?>/images/invoice/logo.png" alt="" class="logo">
          <span>Invoice</span>
          <div class="clearfix"></div>
        </div>
        <div class="invoice_header">
          <div class="pull_left address">
              <h2>Dhaka Medical</h2>
              <p>
                4th Floor, House No. 6, Block- SW(H), <br>
                Bir Uttam Mir Shawkat Sarak,<br> 
                Dhaka 1212, Bangladesh
              </p>
          </div>
          <div class="pull_right">
            <ul class="contact_list">
              <li>
                <i class="fa fa-phone"></i>
                <p>01733435951 <br> 01733435951</p>
              </li>
              <li>
                <i class="fa fa-at"></i>
                <p>rukon.info@gmail.com <br>hospital@gmail.com</p>
              </li>
            </ul>
            <div class="invoice_no_date">
              <div>
                <h2>#Invoice NO</h2>
                <p><?php echo $invoice[0]->id; ?></p>
              </div>
              <div>
                <h2>#Invoice Date</h2>
                <p><?php echo $invoice[0]->date; ?></p>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="invoice_items">
          <table style="width:100%">
            <tr class="items_header">
              <th width="40">S.No.</th>
              <th>DESCRIPTION</th>
              <th width="150">PRICE</th>
            </tr>
            <?php
              $items = json_decode($invoice[0]->data);
              if($items){
                foreach ($items as $key => $value) {
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $value->label; ?></td>
                    <td><?php echo $value->price; ?></td>
                  </tr>
                  <?php
                }
              }
            ?>
          </table> 
        </div>
        <div class="total">
          <h2>GRAND Total <span>:</span><?php echo $invoice[0]->total; ?> TK.</h2>
        </div>
        <div class="footer">
        </div>
      </div>
    </div>
    <div class="print_btn">
      <a href="javascript:window.print();">Print</a>
    </div>
  </body>
</html>