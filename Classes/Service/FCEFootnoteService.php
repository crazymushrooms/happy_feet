<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Render Footnotes for FCE
 *
 * @package HappyFeet
 * @subpackage Service
 * @author Bilal Arslan <bilal.arslan@aoe.com>
 */
class Tx_HappyFeet_Service_FCEFootnoteService extends Tx_HappyFeet_Service_Abstract
{
    /**
     * @var Tx_HappyFeet_Service_Rendering
     */
    private $footnoteRenderer;

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    public $cObj;

    /**
     *
     * @param string $content
     * @param array $conf optional (this will be automatically set, of this method is called via 'TYPOSCRIPT-userFunc')
     * @return string The wrapped index value
     * @throws UnexpectedValueException
     */
    public function renderItemList($content, $conf = array())
    {
        if (false === array_key_exists('userFunc', $conf) || false === array_key_exists('field', $conf)) {
            return '';
        }
        if (array_key_exists('isGridElement', $conf) && (boolean) $conf['isGridElement'] === true) {
            $footnoteUids = $this->getCObj()->data['pi_flexform']['data']['sDEF']['lDEF'][$conf['field']]['vDEF'];
        } else {
            $footnoteUids = $this->getCObj()->getCurrentVal();
        }
        if (empty($footnoteUids)) {
            return '';
        }
        return $this->getRenderingService()->renderFootnotes(explode(',', $footnoteUids));
    }

    /**
     * @param Tx_HappyFeet_Service_Rendering $footnoteRenderer
     */
    public function injectRenderingService(Tx_HappyFeet_Service_Rendering $footnoteRenderer)
    {
        $this->footnoteRenderer = $footnoteRenderer;
    }

    /**
     * @return \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     * @throws UnexpectedValueException
     */
    protected function getCObj()
    {
        if (!$this->cObj instanceof \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer) {
            throw new UnexpectedValueException('cObj was not set', 1393843943);
        }
        return $this->cObj;
    }

    /**
     * @param \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObj
     */
    public function setCObj(TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObj)
    {
        $this->cObj = $cObj;
    }

    /**
     * @return Tx_HappyFeet_Service_Rendering
     */
    protected function getRenderingService()
    {
        if (null === $this->footnoteRenderer) {
            $this->footnoteRenderer = $this->getObjectManager()->get('Tx_HappyFeet_Service_Rendering');
        }
        return $this->footnoteRenderer;
    }
}
