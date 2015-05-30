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

class m_error_c_index extends Controller_Module
{
	public function index()
	{
		header('HTTP/1.0 404 Not Found');

		$this->title('{lang unfound}');

		return array(
			new Panel(array(
				'title'   => '{lang unfound}',
				'icon'    => 'fa-warning',
				'style'   => 'panel-danger',
				'content' => '{lang page_unfound}'
			)),
			new Button_back()
		);
	}

	public function unauthorized()
	{
		header('HTTP/1.0 401 Unauthorized');

		$this->title('{lang unauthorized}');

		return array(
			new Panel(array(
				'title'   => '{lang unauthorized}',
				'icon'    => 'fa-warning',
				'style'   => 'panel-danger',
				'content' => 'Vous n\'avez pas les autorisations d\'accès requises pour visiter cette page.'
			)),
			new Button_back()
		);
	}

	public function database()
	{
		header('HTTP/1.0 503 Service Unavailable');

		$this->title('{lang database}');

		return new Panel(array(
			'title'   => '{lang database}',
			'icon'    => 'fa-warning',
			'style'   => 'panel-danger',
			'content' => 'Le serveur de bases de données est injoignable ou ne répond pas.'
		));
	}
}

/*
NeoFrag Alpha 0.1
./neofrag/modules/error/controllers/index.php
*/