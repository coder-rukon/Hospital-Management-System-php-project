<?php
var_dump($tab);
?>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?php $title; ?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          

          


        


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              	<?php foreach($tab as $tabkey => $tab_item): ?>
                <li role="presentation" class="<?php echo ($tabkey == $tab_active? 'active': ''); ?>"><a href="<?php echo base_url(); ?>settings/options/<?php echo $tabkey; ?>"  aria-expanded="true"><?php echo $tab_item['title']; ?></a></li>
              	<?php endforeach; ?>
              </ul>
              <div id="myTabContent" class="tab-content">

                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <?php include($tab_active.'.php'); ?>
                </div>


              </div>
            </div>

          

      


      </div>
    </div>
  </div>
</div>
