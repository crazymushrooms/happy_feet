<?php
namespace Aoe\HappyFeet\Typo3\Service;

/*
 * Copyright notice
 *
 * (c) 2014 AOE GmbH <dev@aoe.com>
 *
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Cobweb\Linkhandler\ProcessLinkParametersInterface;

/**
 * Linkhandler hook to manipulate link data before it is processed by core typolink method.
 *
 * @package HappyFeet
 * @author Kevin Schu <kevin.schu@aoe.com>
 */
class LinkHandler extends \Tx_HappyFeet_Service_Abstract implements ProcessLinkParametersInterface
{
    /**
     * @param \Cobweb\Linkhandler\TypolinkHandler $linkHandler
     */
    public function process($linkHandler)
    {
        if ('tx_happyfeet_domain_model_footnote' === $linkHandler->getTable()) {
            $footnoteHtml = $this->getRenderingService()->renderFootnotes(array($linkHandler->getUid()));
            // Trim HTML-code of footnotes - Otherwise some ugly problems can occur
            // (e.g. TYPO3 renders p-tags around the HTML-code)
            $linkText = $linkHandler->getLinkText() . trim($footnoteHtml);
            $linkHandler->setLinkText($linkText);
        }
    }

    /**
     * @return \Tx_HappyFeet_Service_Rendering
     */
    protected function getRenderingService()
    {
        /** @var \Tx_HappyFeet_Service_Rendering $renderingService */
        $renderingService = $this->getObjectManager()->get('Tx_HappyFeet_Service_Rendering');
        return $renderingService;
    }
}
