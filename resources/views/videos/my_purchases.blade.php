@extends('layouts.home')

@section('title', 'My Purchases')

@section('content')<head>
<style>.footer{margin-top:2%;}</style></head>
<div class="gt_main_content_wrap">
	<section class="gt_about_bg">
		<div class="container">
			<div class="row">

				<div class="col-lg-12" style="">
					<div class="ibox float-e-margins"><div class="ibox-title">
						<h2>
							My Purchases
						</h2>
					</div>
						@if ($premium)
							<div class="ibox-content" style="height: 370px">
								<div class="row landing-page">
									<ul class="list-unstyled">
										<li class="pricing-title" style="display: block; text-align: center; width: 300px; margin: 0 auto">
											Account Level: Premium
										</li>
									</ul>
								</div>
							</div><!--ibox-content-->
						@else
							<div class="ibox-content">
								<div class="row landing-page">
									<ul class="list-unstyled">
										<li class="pricing-title" style="display: block; text-align: center; width: 300px; margin: 0 auto">
											Account Level: Standard
										</li>
									</ul>
								</div>
								<div class="row landing-page">
									<div class="col-lg-3"></div>
									<div class="col-lg-5 wow zoomIn" style="margin:0 4.16666666%; background: #fafdd7;border-radius: 20px; border: 2px solid black">
										<ul class="pricing-plan list-unstyled" style="margin-top: 0">
											<li class="pricing-desc">
												Want New Video Templates Worth Over $5000 Added To Your Account Each Month With The Latest Personalization, Clickable Video Hotspots Technologies Integrated?
											</li>
											<li class="plan-action">
												<a target="_blank" class="btn btn-primary btn-md" href="http://www.videoplatform.io/l/premium/"><i class="fa fa-shopping-cart"></i>&nbsp;UPGRADE TO PREMIUM<br>$1 TRIAL FOR 31 DAYS
												</a>
											</li>
										</ul>
									</div>
									<div class="col-lg-3"></div>
								</div>
							</div><!--ibox-content-->
						@endif
				</div><!--ibox-->
			</div>


		</div>


	</div>
</section>

</div>


@endsection