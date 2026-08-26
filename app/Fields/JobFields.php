<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class JobFields extends Field
{
	public function fields(): array
	{
		$job = new FieldsBuilder('job_fields', [
			'title' => 'Dane oferty pracy',
			'style' => 'seamless',
			'position' => 'side',
		]);

		$job
			->setLocation('post_type', '==', 'praca')
			->addText('job_location', [
				'label' => 'Lokalizacja',
			])
			->addText('job_contract', [
				'label' => 'Rodzaj umowy',
			]);

		return [$job];
	}
}