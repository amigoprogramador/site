<?php

namespace ICTSoft\Blogfeaturedfiles;

use System\Classes\PluginBase;

class Plugin extends PluginBase {
	public $require = [ 
			'RainLab.Blog' 
	];
	public function boot() {
		\RainLab\Blog\Models\Post::extend ( function ($model) {
			$model->jsonable ( [ 
					'bff_featuredfiles' 
			] );
			$model->addDynamicMethod('hasFeaturedFiles', function() use ($model){
				return $model->bff_featuredfiles !== null && $model->bff_featuredfiles !== "";
			});
			$model->addDynamicMethod('featured_files', function() use ($model){
				$files = [];
				if($model->bff_featuredfiles != null){
					foreach($model->bff_featuredfiles as $id=>$file) {
						$files[] = ['name' => basename($file['featuredfile']), 'path' => $file['featuredfile'] ];
					}
				}
				return $files;
			});
						
		} );
		
		\Event::listen ( 'backend.form.extendFields', function ($widget) {
			
			// Only for the Blog controller
			if (! $widget->getController () instanceof \RainLab\Blog\Controllers\Posts) {
				return;
			}
			
			// Only for the Blog Model
			if (! $widget->model instanceof \RainLab\Blog\Models\Post) {
				return;
			}
			
			if ($widget->getConfig ( 'include', true )) {
				$widget->addSecondaryTabFields ( [ 
						'bff_featuredfiles' => [ 
								'label' => 'Featured Files',
								'tab' => 'rainlab.blog::lang.post.tab_manage',
								'type' => 'repeater',
								'span' => 'left',
								'form' => [ 
										'include' => false,
										'fields' => [ 
												'featuredfile' => [ 
														'label' => 'Featured File',
														'type' => 'mediafinder' 
												],
												'published' => [ 
														'type' => 'text',
														'cssClass' => 'hidden'
												],
												'published_at' => [ 
														'type' => 'text',
														'cssClass' => 'hidden' 
												],
												'hidden' => [ 
														'type' => 'partial',
														'path' => '$/ictsoft/blogfeaturedfiles/partials/_hidden.htm' 
												] 
										] 
								] 
						] 
				]
				 );
			}
		} );
	}
	public function registerComponents() {
	}
	public function registerSettings() {
	}
}
