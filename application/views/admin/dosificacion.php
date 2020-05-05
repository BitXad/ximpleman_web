<?php if($diasdo['dias'] < 0){ ?>
<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" >
    <td>
<div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                  
                  <span class="info-box-text"><font size="4"><b>LA DOSIFICACION YA ESTA VENCIDA </b></font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podra emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
              </div></td>
              </table> 
            </div>
<?php } else {  ?>
<div class="box-body table-responsive">
  <table class="table table-striped table-condensed" style="font-family: Arial;">
    <td>
        <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                               
                    <span class="info-box-text"><font size="4">LA DOSIFICACION VENCERA EN: <font size="5"><b><?php echo $diasdo['dias']; ?></b></font> DIAS</font></span>
                
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    No podrá emitir facturas
                  </span>
                </div><!-- /.info-box-content -->
        </div> 
    </td>
    </table> 
</div>
<?php } ?>