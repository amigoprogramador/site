<?php namespace NetSTI\Backend;

use DB;
use Flash;
use Event;
use Backend;
use Redirect;
use BackendMenu;
use System\Classes\PluginBase;
use System\Models\PluginVersion;
use NetSTI\Backend\Classes\Helper;
use Backend\Classes\Controller as BackendController;

class Plugin extends PluginBase{
	public function boot(){
		Event::listen('backend.menu.extendItems', function($manager) {

			$manager->addMainMenuItems('October.Backend', [
				'dashboard' => [
					'icon'        => 'icon-rocket',
					'iconSvg'	  => 'plugins/netsti/backend/assets/img/dashboard.svg'
				],
			]);

			$manager->addMainMenuItems('October.System', [
				'system' => ['iconSvg' => 'plugins/netsti/backend/assets/img/settings.svg'],
			]);

			$manager->addMainMenuItems('October.Cms', [
				'media' => ['iconSvg' => 'plugins/netsti/backend/assets/img/media.svg'],
				'cms' => ['iconSvg' => 'plugins/netsti/backend/assets/img/cms.svg', 
					'sideMenu' => [
						'pages' => [
							'label'        => 'cms::lang.page.menu_label',
							'icon'         => 'icon-copy',
							'url'          => 'javascript:;',
							'attributes'   => ['data-menu-item' => 'pages'],
							'permissions'  => ['cms.manage_pages'],
							'counterLabel' => 'cms::lang.page.unsaved_label'
						],
						'partials' => [
							'label'        => 'cms::lang.partial.menu_label',
							'icon'         => 'icon-tags',
							'url'          => 'javascript:;',
							'attributes'   => ['data-menu-item' => 'partials'],
							'permissions'  => ['cms.manage_partials'],
							'counterLabel' => 'cms::lang.partial.unsaved_label'
						],
						'layouts' => [
							'label'        => 'cms::lang.layout.menu_label',
							'icon'         => 'icon-th-large',
							'url'          => 'javascript:;',
							'attributes'   => ['data-menu-item' => 'layouts'],
							'permissions'  => ['cms.manage_layouts'],
							'counterLabel' => 'cms::lang.layout.unsaved_label'
						],
						'content' => [
							'label'        => 'cms::lang.content.menu_label',
							'icon'         => 'icon-file-text-o',
							'url'          => 'javascript:;',
							'attributes'   => ['data-menu-item' => 'content'],
							'permissions'  => ['cms.manage_content'],
							'counterLabel' => 'cms::lang.content.unsaved_label'
						],
						// 'blocks' => [
						// 	'label'        => 'Blocks',
						// 	'icon'         => 'icon-cubes',
						// 	'url'          => 'javascript:;',
						// 	'attributes'   => ['data-menu-item' => 'blocks'],
						// 	'permissions'  => ['cms.manage_content'],
						// 	'counterLabel' => 'cms::lang.content.unsaved_label'
						// ],
						'assets' => [
							'label'        => 'cms::lang.asset.menu_label',
							'icon'         => 'icon-picture-o',
							'url'          => 'javascript:;',
							'attributes'   => ['data-menu-item' => 'assets'],
							'permissions'  => ['cms.manage_assets'],
							'counterLabel' => 'cms::lang.asset.unsaved_label'
						],
						'components' => [
							'label'       => 'cms::lang.component.menu_label',
							'icon'        => 'icon-puzzle-piece',
							'url'         => 'javascript:;',
							'attributes'  => ['data-menu-item' => 'components'],
							'permissions' => ['cms.manage_pages', 'cms.manage_layouts', 'cms.manage_partials']
						]
					]
				],
			]);

			if(PluginVersion::where('code', 'RainLab.User')->where('is_disabled', 0)->first()){
				$manager->addMainMenuItems('RainLab.User', [
					'user' => ['iconSvg' => 'plugins/netsti/backend/assets/img/users.svg']
				]);
			}

			if(PluginVersion::where('code', 'RainLab.Blog')->where('is_disabled', 0)->first()){
				$manager->addMainMenuItems('RainLab.Blog', [
					'blog' => ['iconSvg' => 'plugins/netsti/backend/assets/img/blog.svg']
				]);
			}

			$manager->addSideMenuItems('RainLab.User', 'user', [
				'adduser' => [
					'label' => 'rainlab.user::lang.users.new_user',
					'icon' => 'icon-user-plus',
					'url' => Backend::url('rainlab/user/users/create')
				],
				'users' => [
					'label' => 'rainlab.user::lang.users.menu_label',
					'icon' => 'icon-user',
					'url' => Backend::url('rainlab/user/users')
				],
				'usersgroup' => [
					'label' => 'rainlab.user::lang.groups.menu_label',
					'icon' => 'icon-users',
					'url' => Backend::url('rainlab/user/usergroups')
				],
			]);
		});

		$cms_config = base_path() . '/config/cms.php';
		$theme_path = base_path() . '/modules/backend/skins';

		if(Helper::checkTheme($cms_config))
			Helper::rollBack($cms_config);

		BackendController::extend(function($controller){
			$controller->addCss('/plugins/netsti/backend/assets/css/font.css');
			$controller->addCss('/plugins/netsti/backend/assets/css/theme.css');
			$controller->addCss('/plugins/netsti/backend/assets/css/update.css');
			$controller->addJs('/plugins/netsti/backend/assets/js/theme.js');
		});
	}
}
