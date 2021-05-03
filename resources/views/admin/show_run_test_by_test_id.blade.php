@extends('admin_layout')
@section('admin_content')

<div class="content">
    <div class="header text-center">
      <h3 class="title">Timeline</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-timeline card-plain">
          <div class="card-body">
            <ul class="timeline">
            	<?php
            	$page_old = "";
            	$dem = 0;
            	foreach($run_test as $key => $step)
            	{
            	if ($page_old == "" || $page_old == $step['page']) {
            		if ($dem % 2 == 0){
            			?>
		            	<li class="timeline-inverted">
			                <div class="timeline-badge danger">
			                  <i class="tim-icons icon-planet"></i>
			                </div>
			                <div class="timeline-panel">
			                  <div class="timeline-heading">
			                    <span class="badge badge-pill badge-danger">{{$step['page']}}</span>
			                    <span class="badge badge-pill badge-info">{{$step['webDriver']}}</span>
			                  </div>
			                  <div class="timeline-body">
			                    <p>- Mô tả: {{$step['description']}}</p>
			                    <?php
			                    if ($step['action'] == "Error") {
			                    ?>
			                    <p class="text-danger">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }elseif ($step['action'] == "Warning") {
			                    ?>
			                    <p class="text-warning">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }else {
			                    ?>
			                    <p class="text-success">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }
			                    ?>
			                  </div>
			                  <div class="timeline-footer">
		                        <?php
		                        if ($step['data'] != '') {
		                        	if ($step['webDriver'] == 'Screenshot' && $step['action'] == 'End' || $step['action'] == 'Error' || $step['action'] == 'Warning') {
		                        		?>
		                        		<!-- Modal body with image -->
					                    <a href="data:image/png;base64,{{$step['data']}}">
					                        <img class="image-popup-nim" src="data:image/png;base64,{{$step['data']}}" />
					                    </a>
		                        		<?php
		                        	} elseif ($step['action'] == 'Text') {
		                        		?>
		                        		<p>- Content: {{$step['data']}}</p>
		                        		<?php
		                        	}
		                        }
		                        ?>
		                      </div>
			                  <h6>
			                    <i class="ti-time"></i> Thời gian: {{ date("H:i:s d/m/Y", floor($step['timeId']/1000000000)) }}
			                  </h6>
			                  <br>
			                  <?php
			                  if ($step['data1'] != "") {
			                  ?>
			                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
				                <div class="card card-plain">
				                  <div class="card-header" id="headingTwo">
				                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				                      Nhấn để hiện thị Log #
				                      <i class="tim-icons icon-minimal-down"></i>
				                    </a>
				                  </div>
				                  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
				                    <div class="card-body">
				                      {{$step['data1']}}
				                    </div>
				                  </div>
				                </div>
				              </div>
			                  <?php
			                  }
			                  ?>
			                </div>
			            </li>
		            	<?php
            		}else {
            			?>
		            	<li>
			                <div class="timeline-badge success">
			                  <i class="tim-icons icon-user-run"></i>
			                </div>
			                <div class="timeline-panel">
			                  <div class="timeline-heading">
			                    <span class="badge badge-pill badge-success">{{$step['page']}}</span>
			                    <span class="badge badge-pill badge-info">{{$step['webDriver']}}</span>
			                  </div>
			                  <div class="timeline-body">
			                    <p>- Mô tả: {{$step['description']}}</p>
			                    <?php
			                    if ($step['action'] == "Error") {
			                    ?>
			                    <p class="text-danger">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }elseif ($step['action'] == "Warning") {
			                    ?>
			                    <p class="text-warning">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }else {
			                    ?>
			                    <p class="text-success">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }
			                    ?>
			                  </div>
			                  <div class="timeline-footer">
		                        <?php
		                        if ($step['data'] != '') {
		                        	if ($step['webDriver'] == 'Screenshot' && $step['action'] == 'End' || $step['action'] == 'Error' || $step['action'] == 'Warning') {
		                        		?>
		                        		<img src="data:image/gif;base64,{{$step['data']}}" />
		                        		<?php
		                        	} elseif ($step['action'] == 'Text') {
		                        		?>
		                        		<p>- Content: {{$step['data']}}</p>
		                        		<?php
		                        	}
		                        }
		                        ?>
		                      </div>
			                  <h6>
			                    <i class="ti-time"></i> Thời gian: {{ date("H:i:s d/m/Y", floor($step['timeId']/1000000000)) }}
			                  </h6>
			                  <br>
			                  <?php
			                  if ($step['data1'] != "") {
			                  ?>
			                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
				                <div class="card card-plain">
				                  <div class="card-header" id="headingTwo">
				                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				                      Nhấn để hiện thị Log #
				                      <i class="tim-icons icon-minimal-down"></i>
				                    </a>
				                  </div>
				                  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
				                    <div class="card-body">
				                      {{$step['data1']}}
				                    </div>
				                  </div>
				                </div>
				              </div>
			                  <?php
			                  }
			                  ?>
			                </div>
			            </li>
		            	<?php
            		}
            	}else {
            		if ($dem % 2 == 0){
            			$dem++;
            			?>
		            	<li>
			                <div class="timeline-badge success">
			                  <i class="tim-icons icon-user-run"></i>
			                </div>
			                <div class="timeline-panel">
			                  <div class="timeline-heading">
			                    <span class="badge badge-pill badge-success">{{$step['page']}}</span>
			                    <span class="badge badge-pill badge-info">{{$step['webDriver']}}</span>
			                  </div>
			                  <div class="timeline-body">
			                    <p>- Mô tả: {{$step['description']}}</p>
			                    <?php
			                    if ($step['action'] == "Error") {
			                    ?>
			                    <p class="text-danger">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }elseif ($step['action'] == "Warning") {
			                    ?>
			                    <p class="text-warning">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }else {
			                    ?>
			                    <p class="text-success">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }
			                    ?>
			                  </div>
			                  <div class="timeline-footer">
		                        <?php
		                        if ($step['data'] != '') {
		                        	if ($step['webDriver'] == 'Screenshot' && $step['action'] == 'End' || $step['action'] == 'Error' || $step['action'] == 'Warning') {
		                        		?>
		                        		<img src="data:image/gif;base64,{{$step['data']}}" />
		                        		<?php
		                        	} elseif ($step['action'] == 'Text') {
		                        		?>
		                        		<p>- Content: {{$step['data']}}</p>
		                        		<?php
		                        	}
		                        }
		                        ?>
		                      </div>
			                  <h6>
			                    <i class="ti-time"></i> Thời gian: {{ date("H:i:s d/m/Y", floor($step['timeId']/1000000000)) }}
			                  </h6>
			                  <br>
			                  <?php
			                  if ($step['data1'] != "") {
			                  ?>
			                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
				                <div class="card card-plain">
				                  <div class="card-header" id="headingTwo">
				                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				                      Nhấn để hiện thị Log #
				                      <i class="tim-icons icon-minimal-down"></i>
				                    </a>
				                  </div>
				                  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
				                    <div class="card-body">
				                      {{$step['data1']}}
				                    </div>
				                  </div>
				                </div>
				              </div>
			                  <?php
			                  }
			                  ?>
			                </div>
			            </li>
		            	<?php
            		}else {
            			$dem++;
            			?>
		            	<li class="timeline-inverted">
			                <div class="timeline-badge danger">
			                  <i class="tim-icons icon-planet"></i>
			                </div>
			                <div class="timeline-panel">
			                  <div class="timeline-heading">
			                    <span class="badge badge-pill badge-danger">{{$step['page']}}</span>
			                    <span class="badge badge-pill badge-info">{{$step['webDriver']}}</span>
			                  </div>
			                  <div class="timeline-body">
			                    <p>- Mô tả: {{$step['description']}}</p>
			                    <?php
			                    if ($step['action'] == "Error") {
			                    ?>
			                    <p class="text-danger">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }elseif ($step['action'] == "Warning") {
			                    ?>
			                    <p class="text-warning">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }else {
			                    ?>
			                    <p class="text-success">- Hành Động: {{$step['action']}}</p>
			                    <?php
			                    }
			                    ?>
			                  </div>
			                  <div class="timeline-footer">
		                        <?php
		                        if ($step['data'] != '') {
		                        	if ($step['webDriver'] == 'Screenshot' && $step['action'] == 'End' || $step['action'] == 'Error' || $step['action'] == 'Warning') {
		                        		?>
		                        		<img src="data:image/gif;base64,{{$step['data']}}" />
		                        		<?php
		                        	} elseif ($step['action'] == 'Text') {
		                        		?>
		                        		<p>- Content: {{$step['data']}}</p>
		                        		<?php
		                        	}
		                        }
		                        ?>
		                      </div>
			                  <h6>
			                    <i class="ti-time"></i> Thời gian: {{ date("H:i:s d/m/Y", floor($step['timeId']/1000000000)) }}
			                  </h6>
			                  <br>
			                  <?php
			                  if ($step['data1'] != "") {
			                  ?>
			                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
				                <div class="card card-plain">
				                  <div class="card-header" id="headingTwo">
				                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				                      Nhấn để hiện thị Log #
				                      <i class="tim-icons icon-minimal-down"></i>
				                    </a>
				                  </div>
				                  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
				                    <div class="card-body">
				                      {{$step['data1']}}
				                    </div>
				                  </div>
				                </div>
				              </div>
			                  <?php
			                  }
			                  ?>
			                </div>
			            </li>
		            	<?php
            		}

            	}
            	$page_old = $step['page'];
            	}
            	?>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection