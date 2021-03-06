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
namespace n2n\impl\web\dispatch\mag\model\group;

use n2n\impl\web\dispatch\mag\model\BoolMag;
use n2n\reflection\ArgUtils;
use n2n\web\dispatch\map\PropertyPath;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\impl\web\ui\view\html\HtmlUtils;
use n2n\web\ui\UiComponent;
use n2n\web\dispatch\mag\MagWrapper;

class EnablerMag extends BoolMag {
	private $associatedMagWrappers;
	private $htmlId;
	
	public function __construct($propertyName, $labelLstr, bool $value = false, array $associatedMagWrappers = null) {
		parent::__construct($propertyName, $labelLstr, $value);
		$this->setAssociatedMags((array) $associatedMagWrappers);
		$this->htmlId = HtmlUtils::buildUniqueId('n2n-impl-web-dispatch-enabler-group-');
		$this->setInputAttrs(array());
	}
	
	public function setInputAttrs(array $inputAttrs) {
		parent::setInputAttrs(HtmlUtils::mergeAttrs(array(
				'class' => 'n2n-impl-web-dispatch-enabler',
				'data-n2n-impl-web-dispatch-enabler-class' => $this->htmlId), $inputAttrs));
	}
	
	/**
	 * @param MagWrapper[] $associatedMagWrappers
	 */
	public function setAssociatedMags(array $associatedMagWrappers) {
		$this->setAssociatedMagWrappers($associatedMagWrappers);
	}
	
	/**
	 * @param MagWrapper[] $associatedMagWrappers
	 */
	public function setAssociatedMagWrappers(array $associatedMagWrappers) {
		ArgUtils::valArray($associatedMagWrappers, MagWrapper::class, false, 'associatedMagWrappers');
		$this->associatedMagWrappers = $associatedMagWrappers;
	}
	
	/**
	 * @return MagWrapper[] 
	 */
	public function getAssociatedMagWrappers() {
		return $this->associatedMagWrappers;
	}
	
	public function createUiField(PropertyPath $propertyPath, HtmlView $view): UiComponent {
// 		$view->getHtmlBuilder()->meta()->addLibrary(new JQueryLibrary(3, true));
// 		$view->getHtmlBuilder()->meta()->bodyEnd()->addJs('js/ajah.js', 'n2n\impl\web\ui');
		$view->getHtmlBuilder()->meta()->addJs('js/group.js', 'n2n\impl\web\dispatch');
		
		foreach ($this->associatedMagWrappers as $associatedMagWrapper) {
			$associatedMagWrapper->addMarkAttrs(array('class' => $this->htmlId));
		}
			
		return parent::createUiField($propertyPath, $view);
	}
}
