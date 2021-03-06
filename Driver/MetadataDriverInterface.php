<?php
/*
 * This file is part of the Form Metadata library
 *
 * (c) Cameron Manderson <camm@flintinteractive.com.au>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Corleonis\FormMetadataBundle\Driver;

use Corleonis\FormMetadataBundle\FormMetadata;

/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
interface MetadataDriverInterface
{
    /**
     * Read the entity and create an associated metadata
     * @abstract
     * @param $entity
     * @return FormMetadata
     */
    public function getMetadata($entity);
}
