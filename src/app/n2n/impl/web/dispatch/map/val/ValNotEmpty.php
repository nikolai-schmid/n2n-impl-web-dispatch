<?php
/*
 * Copyright (c) 2012-2016, Hofmänner New Media.
 * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS FILE HEADER.
 *
 * This file is part of the N2N FRAMEWORK.
 *
 * The N2N FRAMEWORK is free software: you can redistribute it and/or modify it under the terms of
 * the GNU Lesser General Public License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * N2N is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details: http://www.gnu.org/licenses/
 *
 * The following people participated in this project:
 *
 * Andreas von Burg.....: Architect, Lead Developer
 * Bert Hofmänner.......: Idea, Frontend UI, Community Leader, Marketing
 * Thomas Günther.......: Developer, Hangar
 */
namespace n2n\impl\web\dispatch\map\val;

use n2n\core\N2N;
use n2n\web\dispatch\map\val\SimplePropertyValidator;

class ValNotEmpty extends SimplePropertyValidator {
	const DEFAULT_ERROR_TEXT_CODE = 'n2n.dispatch.val.ValNotEmpty'; 
	
	private $errorMessage;
	
	public function __construct($errorMessage = null) {
		$this->errorMessage = $errorMessage;
	}

	protected function validateValue($value) {
		if ($value !== null && (!is_scalar($value) || mb_strlen(trim($value)))) return;
		
		$this->failed($this->errorMessage, self::DEFAULT_ERROR_TEXT_CODE, array(), 'n2n\impl\web\dispatch');
	}
}
