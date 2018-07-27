<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\validators;

use jamband\ripple\Ripple;

trait RippleValidatorTrait
{
    /**
     * Validates whether a valid URL.
     *
     * @param string $attribute
     * @return void
     */
    public function validateUrl(string $attribute): void
    {
        if (!(new Ripple($this->$attribute))->isValidUrl()) {
            $this->addError($attribute, 'The track URL is not valid.');
        }
    }

    /**
     * Validates whether have a content.
     *
     * @param string $attribute
     * @return void
     */
    public function validateContent(string $attribute): void
    {
        if (null === $this->provider_key) {
            $this->addError($attribute, 'Unable to retrieve the contents from the URL.');
        }
    }
}
