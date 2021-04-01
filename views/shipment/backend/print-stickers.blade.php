<?php 
use \Milon\Barcode\DNS1D;
use App\Shipment;
$d = new DNS1D();

?>
@extends('backend.layouts.app')

@section('content')


<!--begin::Portlet-->
<div class="row">
							
	<div class="col-lg-12">

		<!--begin::Portlet-->
		<div class="kt-portlet">
			<!--begin::Form-->
			<form class="kt-form kt-form--label-right" id="kt_form_1">
				{{ csrf_field() }}
				<div class="kt-portlet__body">
					<?php
						if(Session::has('error_msg')){
				          ?>
					<div class="alert alert-danger  fade show" role="alert">
						<div class="alert-icon"><i class="flaticon-warning"></i></div>
						<div class="alert-text"><?=Session::get('error_msg')?></div>
						<div class="alert-close">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true"><i class="la la-close"></i></span>
							</button>
						</div>
					</div>
					<?php
						}
				          ?>
					<div class="print-container">
						<?php 
						$shipments = $shipments_ids;
						foreach ($shipments as $orderId){
						$model = Shipment::where('id','=',$orderId)->first();
						?>
						<div class="print-block">
							<div class="print-loction">
								<div class="row">
									<div class="col-md-4">
										<p style="float: right;padding-left: 20px;">
                                        @if($model->barcode != null)
											<?= $d->getBarcodeHTML($model->barcode, "EAN13");?>
									 		<p style="margin-top: 10px;"> <?=$model->barcode;?></p>
                                        @endif
                                        </p>
									</div>
                                </div>
                       
							</div>
							
							<div>

							</div>
                        </div>
						<?php } ?>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>
</div>
<style type="text/css">
	.print-block{
		border: 1px solid black;
    border-bottom: none !important;
    padding: 10px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 15px;
    width: 6cm;
    height: 2.5cm;
    /* height: 275px; */
    /* height: 170px; */
    background-color: #ffffff !important;
    background-repeat: no-repeat;
    background-position: inherit;
    color: black;
    /* margin-right: 180px; */
    display: inline-block;
page-break-after:always;
	}
	.print-block{
		font-size: 20px;
	}

	.print-break{
		border: 1px solid black;
	    margin-bottom: 5px;
	    margin-top: -10px;
	}
	.print-loction{
		margin-bottom: 0px;
	}
	.print-loction h2{
		    color: black;
    margin: 0;
    height: 2cm;
	}
@media print {
    .print-block {
        background-color: #ffffff !important;
        -webkit-print-color-adjust: exact; 
    }
    #kt_header{
    	display: none;
    }
    div#kt_content{
    	padding-top: 0px;
    }
    div#kt_header, div#kt_aside, button#kt_aside_close_btn, div#kt_header_mobile{
    	display: none !important;
    }
}
</style>

@endsection
@section('modal')
@include('modals.delete_modal')
@endsection
@section('script')
<script>
window.onload = function() {
	javascript:window.print();
};
</script>
@endsection