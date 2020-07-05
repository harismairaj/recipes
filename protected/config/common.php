<?php
/**
 * This file provides to overwrite the default HumHub / Yii configuration by your local common (Console and Web) environments
 * @see http://www.yiiframework.com/doc-2.0/guide-concept-configurations.html
 * @see http://docs.humhub.org/admin-installation-configuration.html
 * @see http://docs.humhub.org/dev-environment.html
 */

return [
	'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
						'enableStrictParsing' => false,
						'rules' => [
							/*[
								'pattern' => '/',
								'route' => 'custom/home',//directory/directory/spaces
								'suffix' => '/',
								'normalizer' => [
									'collapseSlashes' => true
								]
							]*/
							'custom/modals/create/<contentcontainer_id:\d+>' => 'custom/modals/create',
							'custom/modals/edit/<object_id:\d+>' => 'custom/modals/edit',
							'custom/modals/delete/<content_id:\d+>/<object_id:\d+>' => 'custom/modals/delete'
						]
        ]
    ],
    'params' => [
        'allowedLanguages' => ['en']
    ]
];
