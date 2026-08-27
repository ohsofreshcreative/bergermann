<!--- cats --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-cats relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		@if (!empty($g_cats['header']))
		<h2 data-gsap-element="header" class="m-header">
			{{ $g_cats['header'] }}
		</h2>
		@endif

		@if (!empty($cat_items))
		<div class="__grid mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
			@foreach ($cat_items as $item)
			<div data-gsap-element="card" class="__item __item--card flex flex-col justify-between border border-primary-100 bg-white p-6 xl:p-8">
				@if (!empty($item['icon_url']))
				<div class="__icon flex h-20 w-20 items-center justify-center">
					<img class="object-contain" src="{{ $item['icon_url'] }}" alt="{{ $item['icon_alt'] }}">
				</div>
				@endif

				@if (!empty($item['title']))
				<h3 class="mt-6 text-h7 text-primary-dark">{{ $item['title'] }}</h3>
				@endif

				<div class="mt-6">
					<x-button :href="$item['url']" variant="underline" class="!inline-flex !items-center !gap-2">
						Sprawdź szczegóły
					</x-button>
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
</section>
