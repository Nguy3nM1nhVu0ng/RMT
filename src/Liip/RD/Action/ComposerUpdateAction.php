<?php

namespace Liip\RD\Action;

use Liip\RD\Information\InformationRequest;

class ComposerUpdateAction extends \Liip\RD\Action\BaseAction
{
    public function execute($context)
    {
        $newVersion = $context->getParam('new-version');
        $composerFile = $context->getParam('project-root').'/composer.json';
        if (!file_exists($composerFile)) {
            throw new \Liip\RD\Exception("Impossible to file the composer file ($composerFile)");
        }
        $fileContent = file_get_contents($composerFile);
        $fileContent = preg_replace('/("version":[^,]*,)/', '"version": "'.$newVersion.'",', $fileContent);
        file_put_contents($composerFile, $fileContent);
        $this->confirmSuccess($context);
    }

}
