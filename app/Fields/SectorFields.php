<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SectorFields extends Field
{
	public function fields(): array
	{
		$sector = new FieldsBuilder('sector_fields', [
			'title'    => 'Tagi sektora',
			'style'    => 'seamless',
			'position' => 'side',
		]);

		$sector
			->setLocation('post_type', '==', 'sektor')
			->addRepeater('r_sector_tags', [
				'label'        => 'Tagi',
				'layout'       => 'table',
				'button_label' => 'Dodaj tag',
			])
			->addText('tag', [
				'label' => 'Tag',
			])
			->endRepeater();

		return [$sector];
	}
}
