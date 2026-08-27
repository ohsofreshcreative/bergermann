<!--- hero -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-hero relative overflow-hidden lg:h-[calc(100vh-200px)]' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__glow __glow--blue -top-50 -left-50" aria-hidden="true"></div>
	<div class="__glow __glow--pink left-1/2 -translate-x-1/2 -bottom-1/4" aria-hidden="true"></div>

	@if (!empty($slides))
	<div class="swiper slider-hero h-full relative z-10">
		<div class="swiper-wrapper">
			@foreach ($slides as $slide)
			<div class="swiper-slide">
				<div class="__wrapper relative h-full flex items-center py-14 lg:py-0">
					<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20 relative z-10">
						@if (!empty($slide['image']))
							<x-picture
								data-gsap-element="img"
								:image="$slide['image']"
								figureClass="__img h-full order-2 relative"
								class="w-full object-cover aspect-[4/3] sm:aspect-video lg:aspect-square"
							>
								<span class="__squares hidden lg:block" aria-hidden="true">
									<i></i>
									<i></i>
									<i></i>
									<i></i>
									<i></i>
									<i></i>
								</span>
							</x-picture>
						@endif

						<div class="__content order-1 w-full md:w-3/4 px-6 md:px-0 md:mx-auto">
							<span class="__pixels" aria-hidden="true"><i></i><i></i></span>

							<h1 data-gsap-element="header" class="text-h3">{{ $slide['header'] }}</h1>

							<div data-gsap-element="txt" class="__txt m-header">
								{!! $slide['text'] !!}
							</div>

							@if (!empty($slide['button1']) || !empty($slide['button2']))
							<div class="inline-buttons m-btn">
								@if (!empty($slide['button1']))
								<x-button
									:href="$slide['button1']['url']"
									variant="primary"
									data-gsap-element="btn">
									{{ $slide['button1']['title'] }}
								</x-button>
								@endif

								@if (!empty($slide['button2']))
								<x-button
									:href="$slide['button2']['url']"
									variant="outline-primary"
									data-gsap-element="btn">
									{{ $slide['button2']['title'] }}
								</x-button>
								@endif
							</div>
							@endif

						</div>

					</div>
				</div>
			</div>
			@endforeach
		</div>

		@if (count($slides) > 1)
		<div class="__prev absolute left-0 sm:left-3 lg:left-6 top-1/2 -translate-y-1/2 z-20 bg-secondary h-6 w-6 sm:h-10 sm:w-10 lg:h-12 lg:w-12 flex items-center justify-center cursor-pointer transition-all duration-300 shrink-0">
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none" class="w-2 sm:w-2.5">
				<path d="M0.270429 5.31498C0.270706 5.31469 0.270937 5.31435 0.27126 5.31406L5.08882 0.281803C5.44973 -0.0951806 6.03348 -0.0937777 6.39273 0.285093C6.75194 0.663916 6.75055 1.27664 6.38964 1.65367L3.15514 5.03226L12.078 5.03226C12.5872 5.03226 13 5.46552 13 6C13 6.53448 12.5872 6.96774 12.078 6.96774L3.15518 6.96774L6.3896 10.3463C6.75051 10.7234 6.75189 11.3361 6.39269 11.7149C6.03344 12.0938 5.44963 12.0951 5.08877 11.7182L0.271213 6.68594C0.270936 6.68565 0.270706 6.68531 0.270383 6.68502C-0.0907122 6.30673 -0.08956 5.69202 0.270429 5.31498Z" fill="#FFF" />
			</svg>
		</div>
		<div class="__next absolute right-0 sm:right-3 lg:right-6 top-1/2 -translate-y-1/2 z-20 bg-secondary h-6 w-6 sm:h-10 sm:w-10 lg:h-12 lg:w-12 flex items-center justify-center cursor-pointer transition-all duration-300 shrink-0">
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none" class="w-2 sm:w-2.5">
				<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24945 1.27664 6.61036 1.65367L9.84486 5.03226L0.921985 5.03226C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774L9.84482 6.96774L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96657 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#FFF" />
			</svg>
		</div>
		@endif
	</div>
	@endif

</section>