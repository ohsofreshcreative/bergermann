<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class Cats extends Block
{
	public $name = 'Dla kogo';
	public $description = 'cats';
	public $slug = 'cats';
	public $category = 'formatting';
	public $icon = 'admin-links';
	public $keywords = ['cats', 'pomoc', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$cats = new FieldsBuilder('cats');

		$cats
			->setLocation('block', '==', 'acf/cats')
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_cats', ['label' => ''])
			->addText('header', ['label' => 'Nagłówek'])
			->addTaxonomy('offer_category', [
				'label' => 'Kategoria ofert',
				'taxonomy' => 'offer_category',
				'field_type' => 'select',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			])
			->addMessage('Informacja', 'Blok automatycznie wyświetla oferty (CPT „Oferta”) przypisane do wybranej kategorii ofert.')
			->endGroup()
			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addSelect('background', [
				'label' => 'Kolor tła',
				'choices' => \App\Support\SectionClasses::backgroundChoices(),
				'default_value' => 'none',
				'ui' => 0,
				'allow_null' => 0,
			]);

		return $cats;
	}

	public function with(): array
	{
		$gcats = get_field('g_cats');
		$category = $gcats['offer_category'] ?? null;

		$cat_items = [];
		if (!empty($category)) {
			$offers_query = new \WP_Query([
				'post_type'      => 'offer',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_status'    => 'publish',
				'tax_query'      => [
					[
						'taxonomy' => 'offer_category',
						'field'    => 'term_id',
						'terms'    => $category,
					],
				],
			]);

			foreach ($offers_query->posts as $post) {
				$icon = get_field('offer_icon', $post->ID);
				$cat_items[] = [
					'title'    => $post->post_title,
					'url'      => get_permalink($post->ID),
					'icon_url' => $icon['url'] ?? null,
					'icon_alt' => $icon['alt'] ?? '',
				];
			}
			wp_reset_postdata();
		}

		$fields = [
			'g_cats' => $gcats,
			'cat_items' => $cat_items,
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => (bool) get_field('flip'),
			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),
			'gap' => (bool) get_field('gap'),
			'background' => get_field('background') ?: get_field('default_block_background', 'option') ?: 'none',
		];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'flip' => 'order-flip',
			'wide' => 'wide',
			'nomt' => '!mt-0',
			'gap' => 'wider-gap',
		]);

		return $fields;
	}
}
