<?php if (!defined('NEOFRAG_CMS')) exit;
/**************************************************************************
Copyright © 2015 Michaël BILCOT & Jérémy VALENTIN

This file is part of NeoFrag.

NeoFrag is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

NeoFrag is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with NeoFrag. If not, see <http://www.gnu.org/licenses/>.
**************************************************************************/

class m_comments_c_admin extends Controller_Module
{
	public function index($comments, $modules, $tab)
	{
		$this	->load->library('tab')
				->add_tab('default', 'Tous les commentaires', '_tab_index', $comments);

		foreach ($modules as $module_name => $module)
		{
			list($title, $icon) = $module;
			$this->tab->add_tab($module_name, $this->assets->icon($icon).' '.$title, '_tab_index', $comments, $title);
		}
								
		return new Panel(array(
			'content' => $this->tab->display($tab)
		));
	}
	
	public function _tab_index($comments, $title = NULL)
	{
		$this	->subtitle(is_null($title) ? 'Tous les commentaires' : $title)
					->load->library('table');
		
		if (is_null($title))
		{
			$this->table->add_columns(array(
				array(
					'title'   => 'Module',
					'content' => '<a href="{base_url}admin/comments/{module}.html">{icon {icon}} {module_title}</a>',
					'size'    => '25%',
					'sort'    => '{module_title}',
					'search'  => '{module_title}'
				)
			));
		}
	
		echo $this->table->add_columns(array(
			array(
				'title'   => 'Nom',
				'content' => '{title}',
				'sort'    => '{title}',
				'search'  => '{title}'
			),
			array(
				'title'   => '<i class="fa fa-comments-o" data-toggle="tooltip" title="Nombre de commentaires"></i>',
				'content' => function($data){
					return NeoFrag::loader()->library('comments')->admin_comments($data['module'], $data['module_id'], FALSE);
				},
				'size'    => TRUE
			),
			array(
				'content' => button('{base_url}{url}', 'fa-eye', 'Voir les commentaires', 'info'),
				'size'    => TRUE
			)
		))
		->data($comments)
		->no_data('Il n\'y a pas de commentaire')
		->sort_by(1)
		->display();
	}
}

/*
NeoFrag Alpha 0.1
./neofrag/modules/comments/controllers/admin.php
*/